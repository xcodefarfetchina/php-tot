<?php
	
	/*	
	Created by openthread
	25'O Clock Inc.
	Sep 9 2012
	 */
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/CreateDir.php';
	require_once 'Classes/TOTClasses/GenManifest.php';
	require_once 'Classes/TOTClasses/XMLHelper.php';

	function ServerPath()
	{
		return "http://192.168.1.107/php-tot/";
	}

/*
* $tempFile : handle of uploaded temp file
* return value : is temp file available
*/
	function isTempFileAvailable($tempFile)
	{
		$isFileAvailabel = false;
		echo "<pre>";
		if (($_FILES["file"]["type"] != "application/octet-stream"))//file is not an ipa
		{
			echo "File is not an ipa\n";
		}
		else if ($_FILES["file"]["size"] > 1024 * 1024 * 800)//ipa file size limit to 800M
		{
			echo "File should not be larger than 800M\n";
		}
		else if ($_FILES["file"]["error"] > 0)//上传失败
		{
    		echo "Return Code: " . $_FILES["file"]["error"] . "\n";
		}
		else//Upload successed
		{
			echo "File Available";
			$isFileAvailabel = true;
		}
		echo "</pre>";
		return $isFileAvailabel;
	}

//Move uploaded ipa file from temp dir to "./Temp/"
/*
* $tempFile : uploaded ipa file
* return : new fileName of ipa
*/
	function moveTempFileToTempDir($tempFile)
	{
		print("<pre>");

		$uploadDir = 'Temp/';
		CreateDir($uploadDir);

		//将其复制到非临时目录
		$tempPath = $tempFile['tmp_name'];
		$uploadPath = $uploadDir. "BetaTest.ipa";

		echo "Moving From " . $tempPath . " to " . $uploadPath . "<br />";
		$isMoveSuccessed = false;
		if (move_uploaded_file($tempPath, $uploadPath))
		{
			print "Upload Successed\n";
			$isMoveSuccessed = true;
		}
		else
		{
			print "Move temp file failed, may be a permission issue\n";
		}
		print("</pre>");
		if ($isMoveSuccessed)
		{
			return "BetaTest.ipa";
		}
		return null;
	}

/*
* $tempFile : handle of uploaded temp file
* return value : path of unziped dir of ipa if unzip successed. else null
*/
	function unzipIpaFile($ipaFile)
	{
		unzip($ipaFile, "Temp/");
		return "Temp/";
	}

/*
* $unzipPath : unzipPath of ipa
* return value : path of app dir in unzipPath
*/
	function appPathFromUnzipPath($unzipPath)
	{
		print("<pre>");
		$payloadPath = $unzipPath . "Payload";
		$appPath = null;
		if (file_exists($payloadPath))
		{
			if ($handle = opendir($payloadPath))
			{
				while (false !== ($file = readdir($handle)))
				{
					$isContain = strstr($file, ".app");
					if ($isContain)
					{
						$appPath = $payloadPath . "/" . $file . "/";
					}
				}
				closedir($handle);
			}
		}
		print("</pre>");
		return $appPath;
	}

//如果bundleIdentifer对应的文件夹在Documents中不存在
//或文件夹中不含AppInfo.plist
//或AppInfo.plst中数据不正确
//则删除重建
	function CreateDirForBundleIdentifier($bundleIdentifier)
	{
		$pathForIdentifier = "Documents/" . $bundleIdentifier . "/";
		if (!file_exists($pathForIdentifier))
		{
			CreateDir($pathForIdentifier);
			$xmlArray = array('LastVersion' => "0");
			SaveArrayAsXMLToPath($xmlArray, $pathForIdentifier . "AppInfo.plist");
		}
		else if (file_exists($pathForIdentifier) && !file_exists($pathForIdentifier . "AppInfo.plist"))
		{
			DeleteDir($pathForIdentifier);
			CreateDir($pathForIdentifier);
			$xmlArray = array('LastVersion' => "0");
			SaveArrayAsXMLToPath($xmlArray, $pathForIdentifier . "AppInfo.plist");
		}
		else
		{
			$xmlArray = ArrayFromXMLPath($pathForIdentifier . "AppInfo.plist");
			if (!$xmlArray["LastVersion"])
			{
				DeleteDir($pathForIdentifier);
				CreateDir($pathForIdentifier);
				$xmlArray = array('LastVersion' => "0");
				SaveArrayAsXMLToPath($xmlArray, $pathForIdentifier . "AppInfo.plist");
			}
		}
	}

	function moveTempIpaToIdentifierDir(
		$bundleIdentifier, /*bundle identifier of app */
		$ipaPath, /*path of uploaded ipa file */
		$ipaFileName, /*file name of uploaded ipa file */
		$appPath, /*unziped dir of "*.app/"*/
		$infoArray, /*Info array of app */
		$changeLog /*Change Log of this release */
		)
	{
		//在"Documents/$bundleIdentifier"下新建文件夹$dir,文件夹名为内测版本号
		$identifierXMLPath = "Documents/". $bundleIdentifier . "/AppInfo.plist";
		$identifierInfoArray = ArrayFromXMLPath($identifierXMLPath);
		$betaVersion = $identifierInfoArray['LastVersion'];
		$betaVersion++;
		$identifierInfoArray['LastVersion'] = $betaVersion;
		SaveArrayAsXMLToPath($identifierInfoArray, $identifierXMLPath);
		$dir = "Documents/" . $bundleIdentifier . "/" . $betaVersion . "/";
		CreateDir($dir);

		//将ipaPath的文件移动进$dir
		MoveFile($ipaPath, $dir . $ipaFileName);

		//将$appPath中的iTunesArtwork移动进$dir
		MoveFile($appPath . "iTunesArtwork", $dir . "iTunesArtwork.png");
		$isiTunesArtworkExist = file_exists($appPath . "iTunesArtwork");

		//用$infoArray在$dir中创建manifest.plist
		$serverPath = ServerPath();
		GenManifest(
			$serverPath . $dir . $ipaFileName,
			$bundleIdentifier,
			$infoArray["Version"],
			$infoArray["BundleDisplayName"],
			$dir . "manifest.plist"
		);

		//在$dir中创建VersionInfo.plist，储存Title、Version、BetaVersion、ReleaseDate、ChangeLog
	}

	function main()
	{
		CreateDir("Documents");
		CreateDir("Temp");

		if (!$_FILES)//$_FILES中没有值，上传失败
		{
			echo "Upload failed <br/>";
		}
		else
		{
			$isFileAvailabel = isTempFileAvailable($_FILES["file"]);
			if ($isFileAvailabel)
			{
				$ipaFileName = moveTempFileToTempDir($_FILES["file"]);
				$ipaPath = "Temp/" . $ipaFileName;
				$unzipPath = unzipIpaFile($ipaPath);
				$appPath = appPathFromUnzipPath($unzipPath);
				$infoArray = ArrayFromInfoPlistPath($appPath . "Info.plist");
				$changeLog = "Some Change Log";
				if ($infoArray)
				{
					print"<pre>";
					var_dump($infoArray);
					print"</pre>";
					CreateDirForBundleIdentifier($infoArray["BundleIdentifier"]);
					moveTempIpaToIdentifierDir(
						$infoArray["BundleIdentifier"],
						$ipaPath,
						$ipaFileName,
						$appPath,
						$infoArray,
						$changeLog
						);
				}
			}

			//Remove temp file
			// DeleteDir("Temp");
		}
	}
	main();
?>
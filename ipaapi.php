<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require 'Classes/TOTClasses/XMLHelper.php';
	require 'Classes/TOTClasses/GetRootURL.php';

	//返回某identifier下全部版本的信息列表
	function productInfoArrayForIdentifier($identifier)
	{
		$rootURL = getRootURL();
		$infoArray = array();
		$error = "OK";
		$dir = "Documents/" . $identifier;
		if (file_exists($dir))
		{

			if ($handle = opendir($dir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ($file !== "." && $file !== ".." && is_dir($dir ."/" . $file))//如果$file是文件夹
					{
						$versionInfoPath = $dir . "/" . $file . "/VersionInfo.plist";
						if (file_exists($versionInfoPath))
						{
							$versionInfoArray = ArrayFromXMLPath($versionInfoPath);
							$imagePath = $dir . "/" . $file . "/iTunesArtwork.png";
							if (file_exists($imagePath))
							{
								$versionInfoArray["ImagePath"] = $rootURL . $imagePath;
							}
							else
							{
								$versionInfoArray["ImagePath"] = "";	
							}
							$betaversion = $versionInfoArray["BetaVersion"];
							$infoArray[$betaversion] = $versionInfoArray;
						}
					}
				}
				closedir($handle);
			}
			//按beta version排序
			sort($infoArray);
			if (count($infoArray) == 0)
			{
				$error = "Bundle identifier has no beta version.";
			}
		}
		else
		{
			$error = "Bundle identifier doesn't exist.";
		}
		$returnArray = array("VersionInfo" => $infoArray, "error" => $error);
		return $returnArray;
	}

	//返回某identifier下beta version最大的版本的信息
	//若identifier下无beta version则返回null
	//版本信息中包含此identifier下是否有其他版本（决定是否显示more按钮）
	function lastVersionInfoForIdentifier($identifier)
	{
		$rootURL = getRootURL();
		$dir = "Documents/" . $identifier . "/";
		$maxBetaVersion = 0;
		$maxBetaVersionInfoArray = null;
		$totalBetaVersionCount = 0;
		if (file_exists($dir))
		{
			if ($handle = opendir($dir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ($file !== "." && $file !== ".." && is_dir($dir . $file))//如果$file是文件夹
					{
						$versionInfoPath = $dir . $file . "/VersionInfo.plist";
						$imagePath = $dir . $file . "/iTunesArtwork.png";
						if (file_exists($versionInfoPath))
						{
							$totalBetaVersionCount++;
							$versionInfoArray = ArrayFromXMLPath($versionInfoPath);
							if (file_exists($imagePath))
							{
								$versionInfoArray["ImagePath"] = $rootURL . $imagePath;
							}
							else
							{
								$versionInfoArray["ImagePath"] = "";	
							}
							
							$betaversion = $versionInfoArray["BetaVersion"];
							if ($betaversion > $maxBetaVersion)
							{
								$maxBetaVersion = $betaversion;
								$maxBetaVersionInfoArray = $versionInfoArray;
							}
						}
					}
				}
				closedir($handle);
			}
		}
		if ($maxBetaVersionInfoArray && $totalBetaVersionCount > 1)
		{
			$maxBetaVersionInfoArray["HasMoreBetaVersion"] = true;
		}
		else
		{
			$maxBetaVersionInfoArray["HasMoreBetaVersion"] = false;
		}
		return $maxBetaVersionInfoArray;
	}

	//全部identifier的最后一次发布版本列表
	function allList()
	{
		$serverRootURL = getRootURL();
		//枚举Documents下面所有文件夹
		$documentPath = "Documents/";
		$lastVersionArray = array();
		if (file_exists($documentPath))
		{
			if ($handle = opendir($documentPath))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ($file !== "." && $file !== ".." && is_dir($documentPath . $file))//如果$file是文件夹
					{
						$lastVersionInfo = lastVersionInfoForIdentifier($file);
						$releaseDate = $lastVersionInfo["ReleaseDate"];
						$lastVersionArray[$releaseDate] = $lastVersionInfo;
					}
				}
				closedir($handle);
			}
		}
		sort($lastVersionArray,SORT_NUMERIC);
		if (count($lastVersionArray) == 0)
		{
			$error = "No beta test ipa package available.";
		}
		else
		{
			$error = "OK";
		}
		$returnArray = array("error" => $error, "VersionInfo" => $lastVersionArray);
		return $returnArray;
	}

	function versionDetailForIdentifierAndBetaVersion($identifier,$betaversion)
	{
		$serverRootURL = getRootURL();
		//枚举Documents下面所有文件夹
		$documentPath = "Documents/";
		$versionInfoPath = $documentPath . $identifier . "/" . $betaversion . "/VersionInfo.plist";
		$imagePath = $documentPath . $identifier . "/" . $betaversion . "/iTunesArtwork.png";
		$versionInfoArray = null;
		if (file_exists($versionInfoPath))
		{
			$versionInfoArray = ArrayFromXMLPath($versionInfoPath);
			if (file_exists($imagePath))
			{
				$versionInfoArray["ImagePath"] = $serverRootURL . $imagePath;
			}
			else
			{
				$versionInfoArray["ImagePath"] = "";
			}
		}

		$returnArray = array("error" => "beta version for bundle identifier doesn't exist");
		if ($versionInfoArray)
		{
			$returnArray = array("error" => "OK", "VersionInfo" => $versionInfoArray);
		}
		return $returnArray;
	}

	function main()
	{
		//获取get中的identifier和betaversion
		$identifier = null;
		$betaversion = null;
		if (array_key_exists("identifier", $_GET))
		{
			$identifier = $_GET["identifier"];
		}
		if (array_key_exists("betaversion", $_GET))
		{
			$betaversion = $_GET["betaversion"];
		}

		if ($identifier && !$betaversion)
		{
			$echoArray = productInfoArrayForIdentifier($identifier);
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
		else if ($identifier && $betaversion)
		{
			$echoArray = versionDetailForIdentifierAndBetaVersion($identifier,$betaversion);
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
		else
		{
			$echoArray = allList();
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
	}

	main();
?>
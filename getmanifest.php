<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/FileSystemHelper.php';
	require_once 'Classes/TOTClasses/GenManifest.php';
	require_once 'Classes/TOTClasses/XMLHelper.php';
	require_once(__DIR__.'/Classes/ThirdPartyLib/CFPropertyList/CFPropertyList.php');

	function main()
	{
		//获取get整段参数
		$requestArray = array();
		foreach ($_GET as $key => $value)
		{
			$requestArray[] = $key;
		}
		$getStr = $requestArray[0];
		//由于安装时过来的url中不能带"?" "&"和"#"三种符号，identifier和betaversion用@做分隔符
		$splitArray = explode("@", $getStr);
		$identifier = $splitArray[0];
		$identifier = str_replace("_", ".", $identifier);
		$betaversion = $splitArray[1];

		//identifier不能为空
		if (!$identifier)
		{
			echo "identifier is NULL";
			return;
		}
		//betaversion不能为空
		if (!$betaversion)
		{
			echo "identifier is NULL";
			return;
		}

		//存放此版本的文件夹
		$dirPath = "Documents/" . $identifier . "/" . $betaversion . "/";
		//获取存放此版本的信息的xml路径
		$xmlPath = $dirPath . "VersionInfo.plist";

		//从xml中读取出关联数组
		$versionInfoArray = ArrayFromXMLPath($xmlPath);
		if (!$versionInfoArray)
		{
			echo "Version info is missing!";
		}

		//用版本信息数组生成manifest.plist的xml字符串
		$manifestXMLString = GenManifestXMLString(
			"http://192.168.0.4/php-tot/" . $dirPath . "BetaTest.ipa",
			$versionInfoArray["BundleIdentifier"],
			$versionInfoArray["Version"],
			$versionInfoArray["Title"]
		);
		echo $manifestXMLString;
	}

	$downloadFileName = "manifest.plist";
	header("Content-Disposition: attachment; filename=$downloadFileName");
	main();
?>



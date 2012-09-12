<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require 'Classes/TOTClasses/XMLHelper.php';
	require 'Classes/TOTClasses/GetRootURL.php';

	function infoArrayInDir($dir)
	{
		$infoArray = array();
		if (file_exists($dir))
		{
			if ($handle = opendir($dir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ("." != $file && ".." != $file && !is_file($file))//如果$file是文件夹
					{
						$versionInfoPath = $file . "/VersionInfo.plist";
						if (file_exists($versionInfoPath))
						{
							$versionInfoArray = ArrayFromXMLPath($versionInfoPath);
							var_dump($versionInfoArray);
						}
					}
				}
				closedir($handle);
			}
		}
	}

	function lastVersionInfoInDir($dir)
	{

	}

	function allList()
	{
		$serverRootURL = getRootURL();
		//枚举Documents下面所有文件夹
		$payloadPath = "Documents";
		if (file_exists($payloadPath))
		{
			if ($handle = opendir($payloadPath))
			{
				while (false !== ($file = readdir($handle)))
				{
					if (!is_file($file))//如果$file是文件夹
					{
						$echoArray = infoArrayInDir($file);
					}
				}
				closedir($handle);
			}
		}
	}

	function productListForIdentifier($identifier)
	{

	}

	function versionDetailForIdentifierAndBetaVersion($identifier,$betaversion)
	{

	}

	function main()
	{
		allList();
	}

	echo "<br/>";
	echo "<pre>";

	main();

	echo "</pre>";
?>
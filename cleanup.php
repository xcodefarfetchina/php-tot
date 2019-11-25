<?php
	
	/*	
	Created by Canius Chu
	Nov 22 2019
	 */

	namespace PHP_TOT_OTAServer;

	require_once  'Classes/TOTClasses/XMLHelper.php';
	require_once  'Classes/TOTClasses/SortHelper.php';
	require_once  'Classes/TOTClasses/FileSystemHelper.php';

	function allVersionInfoForIdentifier($identifier)
	{
		$dir = "Documents/" . $identifier . "/";
		$maxBetaVersion = 0;
		$maxBetaVersionInfoArray = [];
		if (file_exists($dir))
		{
			if ($handle = opendir($dir))
			{
				while (false !== ($file = readdir($handle)))
				{
					if ($file !== "." && $file !== ".." && is_dir($dir . $file))//如果$file是文件夹
					{
						$versionInfoPath = $dir . $file . "/VersionInfo.plist";
						if (file_exists($versionInfoPath))
						{
							$versionInfoArray = ArrayFromXMLPath($versionInfoPath);
							$maxBetaVersionInfoArray[] = $versionInfoArray;
						}
					}
				}
				closedir($handle);
			}
		}
		return $maxBetaVersionInfoArray;
	}

	function cleanup($identifier, $max)
	{
		$versions = allVersionInfoForIdentifier($identifier);
		$sortHelper = new SortHelper;
		$sorted = $sortHelper->ReversedSortArrayWithKey($versions, 'ReleaseDate');
		$index = 0;
		foreach ($sorted as $version)
		{
			if ($index >= $max) 
			{
				$dir = "Documents/" . $identifier . "/" . $version["BetaVersion"];
				DeleteDir($dir);
			}
			$index++;
		}
	}
?>
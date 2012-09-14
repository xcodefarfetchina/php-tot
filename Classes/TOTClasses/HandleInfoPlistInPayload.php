<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once(__DIR__.'/../ThirdPartyLib/CFPropertyList/CFPropertyList.php');


	function ArrayFromInfoPlistPath($infoPlistPath)
	{
		$xmlPath = $infoPlistPath;
		$returnArray = null;
		if (file_exists($xmlPath))
		{
			$content = file_get_contents($xmlPath);
			$plist = new CFPropertyList\CFPropertyList();
			$plist->parse($content);
			$plistArray = $plist->toArray();

			// print("<pre>");
			// var_dump($plistArray);
			// print("</pre>");

			$returnArray = array();
			//VersionString

			if (array_key_exists('CFBundleShortVersionString', $plistArray) && ($plistArray['CFBundleShortVersionString']))
			{
				$versionString = 
					$plistArray['CFBundleShortVersionString'] .
				 	' (' .
					$plistArray['CFBundleVersion'] .
					')';
			}
			else
			{
				$versionString = $plistArray['CFBundleVersion'];
			}
			//Bundle identifier
			$bundleIdentifier = $plistArray['CFBundleIdentifier'];
			//Bundle dir
			$minOSVersion = $plistArray['MinimumOSVersion'];
			//Bundle display name
			if ($plistArray['CFBundleDisplayName'])
			{
				$bundleDisplayName = $plistArray['CFBundleDisplayName'];
			}
			else
			{
				$bundleDisplayName = "";
			}

			$returnArray['Version'] = $versionString;
			$returnArray['BundleIdentifier'] = $bundleIdentifier;
			$returnArray['BundleDisplayName'] = $bundleDisplayName;
			$returnArray['MinOSVersion'] = $minOSVersion;

		}
		return $returnArray;
	}
?>
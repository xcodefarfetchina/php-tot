<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */

	namespace PHP_TOT_OTAServer;

	require_once(__DIR__.'/../ThirdPartyLib/CFPropertyList/CFPropertyList.php');


	function ArrayFromInfoPlistPath($infoPlistPath)
	{
		$xmlPath = $infoPlistPath;
		$returnArray = null;
		if (file_exists($xmlPath))
		{
			$content = file_get_contents($xmlPath);
			$plist = new \CFPropertyList\CFPropertyList();
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
			if (array_key_exists('CFBundleDisplayName', $plistArray))
			{
				$bundleDisplayName = $plistArray['CFBundleDisplayName'];
			}
			else if(array_key_exists('CFBundleName', $plistArray))
			{
				$bundleDisplayName = $plistArray['CFBundleName'];
			}
			else
			{
				$bundleDisplayName = $plistArray['CFBundleIdentifier'];	
			}

			$returnArray['Version'] = $versionString;
			$returnArray['BundleIdentifier'] = $bundleIdentifier;
			$returnArray['BundleDisplayName'] = $bundleDisplayName;
			$returnArray['MinOSVersion'] = $minOSVersion;

		}
		return $returnArray;
	}
?>
<?php

require_once("XMLHelper.php");

/*
* return value : array of manifest
*/
	function GenManifestArray(
		$ipaURL,
		$bundleIdentifier,
		$bundleVersion,
		$title
		)
	{
		//Generate xml structure
		$assetsDictionary = array(
			'kind' => 'software-package', 
			'url' => $ipaURL,
			);
		$assetsArray = array($assetsDictionary);

		$metadataDictionary = array(
			'bundle-identifier' => $bundleIdentifier,
			'bundle-version' => $bundleVersion,
			'kind' => 'software',
			'title' => $title,
			);

		$innerManifestDictionary = array(
			'assets' => $assetsArray,
			'metadata' => $metadataDictionary,
			);

		$innerManifestArray = array($innerManifestDictionary);

		$outerManitetDictionary = array(
			'items' => $innerManifestArray,
			);

		//Return manifest dictionary
		return $outerManitetDictionary;
	}

	function GenManifestXMLString(
		$ipaURL,
		$bundleIdentifier,
		$bundleVersion,
		$title
	)
	{
		//Generate manifest dictionary
		$outerManitetDictionary = GenManifestArray(
			$ipaURL,
			$bundleIdentifier,
			$bundleVersion,
			$title
		);

		//Write to disk
		$content = XMLStringFromArray($outerManitetDictionary);
		return $content;
	}

/*
* return value : void
*/
	function WriteManifestToDisk(
		$ipaURL,
		$bundleIdentifier,
		$bundleVersion,
		$title,
		$savingPath
		)
	{
		//Generate manifest dictionary
		$outerManitetDictionary = GenManifestArray(
			$ipaURL,
			$bundleIdentifier,
			$bundleVersion,
			$title
		);

		//Write to disk
		SaveArrayAsXMLToPath($outerManitetDictionary,$savingPath);

		return;
	}

?>
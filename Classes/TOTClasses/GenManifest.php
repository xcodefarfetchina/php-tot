<?php

require_once("XMLHelper.php");

	function GenManifest(
		$ipaURL,
		$bundleIdentifier,
		$bundleVersion,
		$title,
		$savingPath
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

		//Write to disk
		SaveArrayAsXMLToPath($outerManitetDictionary,$savingPath);
		//Return manifest dictionary
		return $outerManitetDictionary;
	}
?>
<?php

	require_once(__DIR__.'/../ThirdPartyLib/CFPropertyList/CFPropertyList.php');

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
		$td = new CFPropertyList\CFTypeDetector();  
		$guessedStructure = $td->toCFType( $outerManitetDictionary );
		$plist = new CFPropertyList\CFPropertyList();
		$plist->add( $guessedStructure );
		$plist->saveXML($savingPath);

		//Return manifest dictionary
		return $outerManitetDictionary;
	}
?>
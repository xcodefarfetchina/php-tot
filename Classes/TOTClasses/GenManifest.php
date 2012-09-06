<?php
	function GenManifest($ipaURL,$bundleIdentifier,$bundleVersion,$title)
	{
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
			'items' => $innerManifestDictionary,
			);

		return $outerManitetDictionary;
	}
?>
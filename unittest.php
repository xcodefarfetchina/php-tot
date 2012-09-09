<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/FileSystemHelper.php';
	require_once 'Classes/TOTClasses/GenManifest.php';
	require_once(__DIR__.'/Classes/ThirdPartyLib/CFPropertyList/CFPropertyList.php');

	echo "<br/>";
	echo "<pre>";
	$manifestDictionary = GenManifest(
		'http://192.168.1.129/issue//issue%201.0.ipa',
	 	'com.openthread.issue',
	 	'1.0 (1.0)',
	 	'issue',
	 	'Temp/manifest.plist');
	var_dump($manifestDictionary);

	echo "</pre>";
?>
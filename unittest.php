<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/CreateDir.php';
	require_once 'Classes/TOTClasses/GenManifest.php';
	require_once(__DIR__.'/Classes/ThirdPartyLib/CFPropertyList/CFPropertyList.php');

	echo "<br/>";
	echo "<pre>";
	$manifestDictionary = GenManifest(
		'http://1',
	 	'com.163.yxpiosclient',
	 	'1.0 (1.0)',
	 	'issue');
	var_dump($manifestDictionary);

	echo "</pre>";
?>
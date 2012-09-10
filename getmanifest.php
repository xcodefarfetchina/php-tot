<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/FileSystemHelper.php';
	require_once 'Classes/TOTClasses/GenManifest.php';
	require_once 'Classes/TOTClasses/XMLHelper.php';
	require_once(__DIR__.'/Classes/ThirdPartyLib/CFPropertyList/CFPropertyList.php');

	$xmlPath = "Documents/com.openthread.issue/1/manifest.plist";
	$content = file_get_contents($xmlPath);
	echo $content;
?>
<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */

	namespace PHP_TOT_OTAServer;
	
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require 'Classes/TOTClasses/GetVersionList.php';

	function ipaAPIMain()
	{
		//获取get中的identifier和betaversion
		$identifier = null;
		$betaversion = null;
		if (array_key_exists("identifier", $_GET))
		{
			$identifier = $_GET["identifier"];
		}
		if (array_key_exists("betaversion", $_GET))
		{
			$betaversion = $_GET["betaversion"];
		}

		if ($identifier && !$betaversion)
		{
			$echoArray = productInfoArrayForIdentifier($identifier);
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
		else if ($identifier && $betaversion)
		{
			$echoArray = versionDetailForIdentifierAndBetaVersion($identifier,$betaversion);
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
		else
		{
			$echoArray = allList();
			$jsonValue = json_encode($echoArray);
			print($jsonValue);
		}
	}

	ipaAPIMain();
?>
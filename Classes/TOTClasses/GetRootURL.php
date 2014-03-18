<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */

	namespace PHP_TOT_OTAServer;

	function getRootURL()
	{
		$host = $_SERVER["HTTP_HOST"];
		$uri = $_SERVER["REQUEST_URI"];

		$uriArray = explode("/", $uri);

		$finalRootURL = $host . "/";

		for ($i=0; $i < count($uriArray) - 1 ; $i++)
		{ 
			$value = $uriArray[$i];
			if ($value && $value !== "")
			{
				$finalRootURL .= "$value";
				$finalRootURL .= "/";
			}
		}
		$bHTTPS = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on";
		return ( $bHTTPS ? "https://" : "http://" ) . $finalRootURL;
	}
?>

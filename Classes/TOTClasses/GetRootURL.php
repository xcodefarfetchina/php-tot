<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

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
		return $finalRootURL;
	}
?>
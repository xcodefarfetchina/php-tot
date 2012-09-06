<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once(__DIR__.'/../ThirdPartyLib/CFPropertyList/CFPropertyList.php');


	function HandleInfoPlistInPayload($payloadPath)
	{
		$xmlPath = $payloadPath . "issue.app/" . "Info.plist";
		echo("<pre>");
		if (file_exists($xmlPath))
		{
			print("Load binary plist at path : " . $xmlPath . "\n");
			$content = file_get_contents($xmlPath);
			$plist = new CFPropertyList\CFPropertyList();
			$plist->parse($content);
			var_dump( $plist->toArray() );
		}
		else
		{
			print("File doesn't exist at $xmlPath");
		}
		echo "</pre>";
	}
?>
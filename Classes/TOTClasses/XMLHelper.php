<?php

	require_once(__DIR__.'/../ThirdPartyLib/CFPropertyList/CFPropertyList.php');

	function ArrayFromXMLPath($xmlPath)
	{
		$plist = new CFPropertyList\CFPropertyList($xmlPath, CFPropertyList\CFPropertyList::FORMAT_XML);
		return $plist->toArray();
	}

	function SaveArrayAsXMLToPath($savingArray, $xmlPath)
	{
		$td = new CFPropertyList\CFTypeDetector();  
		$guessedStructure = $td->toCFType( $savingArray );
		$plist = new CFPropertyList\CFPropertyList();
		$plist->add( $guessedStructure );
		$plist->saveXML($xmlPath);
	}

	function XMLStringFromArray($array)
	{
		$td = new CFPropertyList\CFTypeDetector();  
		$guessedStructure = $td->toCFType( $array );
		$plist = new CFPropertyList\CFPropertyList();
		$plist->add( $guessedStructure );
		$content = $plist->toXML();
		return $content;
	}
?>
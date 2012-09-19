<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */

	namespace PHP_TOT_OTAServer;

	function unzip($filePath, $destinationDir)
	{
		echo "unzip " . $filePath . '<br />';

		$zip = new \ZipArchive;
		$res = $zip->open($filePath);

		if ($res === TRUE)
		{
			$zip->extractTo($destinationDir);
			$zip->close();
			echo 'Archive ' . $filePath . ' finished!';
		}
		else
		{
			echo 'Archive ' . $filePath . ' failed!';
		}
	}
?>
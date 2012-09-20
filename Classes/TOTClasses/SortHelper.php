<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */

	namespace PHP_TOT_OTAServer;

	class SortHelper
	{
		var $sortKey;
		function compareByString($a, $b)
		{
			$key = $this->sortKey;
			return strcmp($a[$key], $b[$key]);
		}

		function rcompareByString($a, $b)
		{
			$key = $this->sortKey;
			return - strcmp($a[$key], $b[$key]);
		}

		function SortArrayWithKey($fruits, $key)
		{
			$this->sortKey = $key;
			usort($fruits, array($this, "compareByString"));
			return $fruits;
		}

		function ReversedSortArrayWithKey($fruits, $key)
		{
			$this->sortKey = $key;
			usort($fruits, array($this, "rcompareByString"));
			return $fruits;
		}
	}
?>
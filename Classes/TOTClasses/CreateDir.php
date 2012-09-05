<?php
	function CreateDir($creatingPath)
	{
			if (!file_exists($creatingPath))
			{
				echo "即将创建目录\"" . $creatingPath . "\"<br />";
				if (mkdir($creatingPath))
				{
					echo "创建\"" . $creatingPath . "\"成功<br />";
				}
				else
				{
					echo "创建\"" . $creatingPath . "\"失败<br />";
				}
			}
	}
?>
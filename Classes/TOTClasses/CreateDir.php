<?php
	function CreateDir($creatingPath)
	{
		if (!file_exists($creatingPath))
		{
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

	function MoveFile($fromPath, $toPath)
	{
		if (!file_exists($fromPath))
		{
			return false;
		}
		$moveSuccessed = rename($fromPath, $toPath);
		return $moveSuccessed;
	}

	function DeleteDir($deletingPath)
	{
		if (file_exists($deletingPath))
		{
			if(deldir($deletingPath))
			{
				echo "delete \"" . $deletingPath . "\" successed";
			}
		}
	}

	function deldir($dir)
	{
		//先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh))
		{
			if($file!="." && $file!="..")
			{
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath))
				{
					unlink($fullpath);
				}
				else
				{
					deldir($fullpath);
				}
			}
		}

		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>
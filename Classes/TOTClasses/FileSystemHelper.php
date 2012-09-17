<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */
	//如果文件已存在，返回false
	//如果创建失败，返回false
	//如果创建成功，返回true
	function CreateDir($creatingPath)
	{
		if (!file_exists($creatingPath))
		{
			if (mkdir($creatingPath))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return false;
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
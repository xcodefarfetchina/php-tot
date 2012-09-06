<?php
	error_reporting( E_ALL );
	ini_set( 'display_errors', 'on' );

	require_once 'Classes/TOTClasses/unzip.php';
	require_once 'Classes/TOTClasses/HandleInfoPlistInPayload.php';
	require_once 'Classes/TOTClasses/CreateDir.php';
	require_once 'Classes/TOTClasses/GenManifest.php';

	CreateDir("Documents");
	CreateDir("Temp");

	if (!$_FILES)//$_FILES中没有值，上传失败
	{
		echo "Upload failed <br/>";
	}
	else if (($_FILES["file"]["type"] == "application/octet-stream")//文件格式限制为ipa
	&& ($_FILES["file"]["size"] < 1024 * 1024 * 20))//最大上传20M
  	{
		if ($_FILES["file"]["error"] > 0)//上传失败
		{
    		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else//上传成功
		{
			//显示上传文件信息
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

			$uploadDir = 'Temp/';

			CreateDir($uploadDir);

			//将其复制到非临时目录
			$tempPath = $_FILES['file']['tmp_name'];
			$uploadPath = $uploadDir. $_FILES['file']['name'];

			echo "Moveing From " . $tempPath . " to " . $uploadPath . "<br />";

			print("<pre>");
			if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath))
			{
				print "Upload Successed\n";
				unzip($uploadPath, $uploadDir);
				HandleInfoPlistInPayload($uploadDir . "Payload/");
			}
			else
			{
				print "Possible file upload attack!  Here's some debugging info:\n";
				print_r($_FILES);
			}
			print("</pre>");
		}
	}
	else//文件不符合要求
	{
		echo "Invalid file";
	}
?>
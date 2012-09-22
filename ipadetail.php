<?php
	namespace PHP_TOT_OTAServer;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>

<link rel="stylesheet" type="text/css" href="Resources/axelfamilyfont.css"/>
<link rel="stylesheet" type="text/css" href="Resources/generalstyle.css"/>

<link rel="apple-touch-icon-precomposed" href="Images/Icon.png"/>
<link rel="shortcut icon" href="Images/Icon.png"/>

<link rel="apple-touch-startup-image" href="Images/Default.png" media="(device-width: 320px)" sizes="320x460"/>
<link rel="apple-touch-startup-image" href="Images/Default@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" sizes="640x920"/>
<link rel="apple-touch-startup-image" href="Images/Default-568h@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" sizes="640x1096"/>

<link href="Images/DefaultIpadPortrait.png" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadPortrait@2x.png" media="(device-width: 768px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadLandscape.png" media="(device-width: 768px) and (orientation: landscape)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadLandscape@2x.png" media="(device-width: 768px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>

<title>TOT - Version Detail</title>
</head>

<SCRIPT LANGUAGE="JScript">
function backToPage(location)
{
    document.location=(location);
}
</SCRIPT>

<!-- 以上是Header -->

<body>

<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */
	require 'Classes/TOTClasses/GetVersionList.php';
	require 'Classes/TOTClasses/GetRootURL.php';

	function titleHTMLStringWithAppTitle($title,$backURI)
	{
		$titleLabelString = "";
		if (!$title || $title === "")
		{
			$titleLabelString = "Error";
		}
		else
		{
			$titleLabelString = "Install " . $title;
		}
		if (!$backURI || $backURI === "")
		{
			$backURI = "index.php";
		}
		$titleString = "";
		$titleString .= "<div class=\"navigationBar\">";
		$titleString .= "<h1 class=\"headerTitle\">$titleLabelString</h1>";
		$titleString .= "<div style=\"position:absolute; top:7px; left:4px\">";
		$titleString .= "<img onclick=\"backToPage('$backURI')\" width=50px; height=30px; src=\"Images/GrayBackButtonHD.png\"/>";
		$titleString .= "</div>";
		$titleString .= "</div>";
		return $titleString;
	}

	function errorHTMLStringWithError($error)
	{
		$errorString = "<h1 class=\"errorLabel\">" . $error . "</h1>";
		return $errorString;
	}

	$identifier = null;
	$betaversion = null;
	$backuri = null;
	if (array_key_exists("identifier", $_GET))
	{
		$identifier = $_GET["identifier"];
	}
	if (array_key_exists("betaversion", $_GET))
	{
		$betaversion = $_GET["betaversion"];
	}
	if (array_key_exists("backuri", $_GET))
	{
		$backuri = $_GET["backuri"];
	}

	$titleHTMLString = "";
	$bodyHTMLString = "";
	$errorHTMLString = "";
	if (!$identifier || !$betaversion)
	{
		$titleHTMLString .= titleHTMLStringWithAppTitle("",$backuri);
		$errorHTMLString .= errorHTMLStringWithError("identifier and betaversion is required");
	}
	else
	{
		$versionInfo = versionDetailForIdentifierAndBetaVersion($identifier,$betaversion);
		$error = $versionInfo['error'];
		if ($error === "OK")//成功
		{
			$serverRootURL = getRootURL();
			$value = $versionInfo['VersionInfo'];
			//从数组中读取所需信息
			//标题
			$title = $value['Title'];
			//版本号
			$version = $value['Version'];
			//内测版本号
			$betaVersion = $value['BetaVersion'];
			//发布日期
			date_default_timezone_set('PRC');
			$dateString = date('F d, Y', $value['ReleaseDate']);
			//下载地址
			$manifestURL = $serverRootURL . "getmanifest.php?" . $value["BundleIdentifier"] . "@" . $value["BetaVersion"];
			//Icon
			$imagePath = $value['ImagePath'];
			if (!$imagePath || $imagePath === "")
			{
				$imagePath = "Images/Icon.png";
			}
			$changeLog = $value['ChangeLog'];

			$titleHTMLString .= titleHTMLStringWithAppTitle($title,$backuri);

			$bodyHTMLString .= "<div class=\"detailCell\">";

			//Icon Container
			$bodyHTMLString .= "<div class=\"iconContainer\">";
			$bodyHTMLString .= "<img class=\"iconImage\" src=\"$imagePath\"/>";
			$bodyHTMLString .= "<img class=\"iconRoundedRectImage\" src=\"Images/RoundedRectAngel.png\"/>";
			$bodyHTMLString .= "</div>";

			//Label Container
			$bodyHTMLString .= "<div class=\"labelOuterContentView\">";
			$bodyHTMLString .= "<div class=\"labelInnerContentView\">";
			$bodyHTMLString .= "<p class=\"cellTitleLabel\">$title $version</p>";
			$bodyHTMLString .= "<p class=\"cellVersionLabel\">#" . $betaVersion . "</p>";
			$bodyHTMLString .= "<p class=\"cellDateLabel\">$dateString</p>";
			$bodyHTMLString .= "</div>";
			$bodyHTMLString .= "</div>";

			//表示详细信息的小三角
			$bodyHTMLString .= "<img class=\"horizontalDetailButton\" src=\"Images/DetailButtonHorizontal.png\"/>";		

			//Change Log
			$bodyHTMLString .= "<div style=\"height:21px;\">";
			$bodyHTMLString .= "<p class=\"changeLogTitle\">Change Log:</p>";
			$bodyHTMLString .= "</div>";
			$bodyHTMLString .= "<div style=\"word-break: break-all; word-wrap:break-word;\">";
			$bodyHTMLString .= "<div class=\"dymain\">";
			$bodyHTMLString .= "<table>";
			$bodyHTMLString .= "<tr>";
			$bodyHTMLString .= "<td>";
			$bodyHTMLString .= "<p style=\"white-space:pre-wrap; font-family: AxelBold; color: #333333; font-size: 16px; padding-left:12px; padding-right:12px; padding-top:3px;\">$changeLog</p>";
			$bodyHTMLString .= "</td>";
			$bodyHTMLString .= "</tr>";
			$bodyHTMLString .= "</table>";
			$bodyHTMLString .= "</div>";
			$bodyHTMLString .= "</div>";

			//安装按钮
			$bodyHTMLString .= "<div class=\"installButton\" style=\"margin-top:7px;\">";
			$bodyHTMLString .= "<a href=\"itms-services://?action=download-manifest&url=$manifestURL\">";
			$bodyHTMLString .= "<img width = 100px; height=44px; src=\"Images/InstallButton.png\"/>";				
			$bodyHTMLString .= "</a>";
			$bodyHTMLString .= "</div>";

			//按钮和版权信息间隔的底边
			$bodyHTMLString .= "<div style=\"height:7px; background:#f3f3f3;\">";
			$bodyHTMLString .= "</div>";

			$bodyHTMLString .= "</div>";
		}
		else//失败
		{
			$titleHTMLString .= titleHTMLStringWithAppTitle("",$backuri);
			$errorHTMLString .= errorHTMLStringWithError($error);
		}
	}
	echo $titleHTMLString;
	echo $bodyHTMLString;
	echo $errorHTMLString;
?>

<!-- 以下是Footer -->

<div style="height:44px;"> 
</div>
<div style="height:33px;">
	<a href="http://github.com/openfibers/php-tot">
		<h1 class="downloadLabel">Download TOT Server</h1>
	</a>
</div>
<div style="height:33px;"> 
	<a href="mailto:openfibers@gmail.com">
		<div>
		<h1 class="contractMeLabel">Contact Author</h1>
		</div>
	</a>
</div>

<h1>Powered by PHP-TOT</h1>
<h1>Copyright (c) 2012, Open Fibers</h1>
<h1 style="height:33px">All rights reserved.</h1>


</body>
</html>

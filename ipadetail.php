<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" type="text/css" href="Resources/axelfamilyfont.css"/>
<link rel="apple-touch-icon-precomposed" href="Images/Icon.png"/>
<link rel="shortcut icon" href="Images/Icon.png" >
<link href="Images/Default.jpg" media="(device-width: 320px)" rel="apple-touch-startup-image">
<link href="Images/DefaultIpadPortrait.jpg" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image">
<link href="Images/DefaultIpadLandscape.jpg" media="(device-width: 768px) and (orientation: landscape)" rel="apple-touch-startup-image">
<link href="Images/DefaultIpadLandscape@2x.jpg" media="(device-width: 768px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<title>TOT</title>
<style type="text/css">
/*背景*/
body {background:#283b4c; background-image:url(Images/Background.png); background-repeat:repeat; margin:0; padding:0; font-family:AxelRegular,helvetica,arial,sans-serif; font-size:16px;}
/*标题Label默认属性*/
h1 {margin:0; padding:0; font-size:13px;text-align:center; color: #aaa}
/*普通Label默认属性*/
p {font-size:13px;}

a:link{text-decoration:none}
a:visited{text-decoration:none}
a:hover {text-decoration:none}

/*顶部NavigationBar布局*/
#header {height:44px; background-image:url(Images/HeaderTitle.png);  margin:0 auto;}
/*顶部Title*/
.headerTitle {padding-top: 11px;font-size:16px;margin: 0 auto; overflow: hidden; width: 196px; font-family:AxelRegular; color:#252525; text-shadow: 0px 1px 0px #fff;}

/*cell布局*/
.cell {background:#f3f3f3; border-top:0px solid #fff; border-bottom:0px solid #d3d3d3; margin-top: 0px}
.cell a {text-decoration:none; height:89px; font-size:15px; display:block; color:#000;}

/*Icon Container*/
.iconContainer {padding-left: 16px; padding-top: 16px; width: 57px; height: 57px}
/*Icon*/
.iconImage {width: 57px; height: 57px}
/*Icon Rounded Rect*/
.iconRoundedRectImage {margin-left: 0px; margin-top: -57px; width: 57px; height: 57px}
/*Detail Button*/
.detailButton {width: 15px; height: 9px; margin-top: -32px; position:absolute;right:10px;}

/*外部装载三个label和MoreButton的view*/
.labelOuterContentView {height: 57px; margin-top: -61px;position: absolute;right: 30px;left: 89px;}
/*内部装载三个label的view*/
.labelInnerContentView {padding-top: 30px; width: 201px; height: 27px; margin: 0 auto}
/*cell中title、版本号的Label*/
.cellTitleLabel {padding-left: 0px; overflow: hidden; width: 201px; height: 21px; padding-top: 35px; font-size: 16px; font-family:AxelBold; color:#333333; margin-top: -62px}
/*cell中发布号、介绍的Label*/
.cellVersionLabel {padding-left: 0px; overflow: hidden; width: 201px; height: 21px; padding-top: 0px; font-size: 16px; font-family:AxelBold; color:#333333; margin-top: -17px}
/*标记时间的label*/
.cellDateLabel {padding-left: 0px; overflow: hidden; width: 165px; height: 21px; font-size: 16px; margin-top: -17px; color: #3668ff}

/*自适应高度的div*/
.dymain {
    margin:auto;
    background-color:#f3f3f3;
}
.dymain table {
    margin-left : 0;
}
/*ChangeLog*/
.changeLogTitle {position: absolute; left: 10px; font-family: AxelBold; color: #333333; font-size: 16px}
.changeLogDetail {position: absolute; left: 15px; right: 15px; font-family: AxelBold; color: #444444; font-size: 16px;}


/*installButton*/
.installButton {position: relative;bottom: 0px; width: 100px; height: 44px; margin: 0 auto; padding-bottom: 10px}
.installButton a {width: 100px; height: 44px;}


.errorLabel {padding-top: 88px;font-size:16px; font-family:AxelRegular; color:#fff;}
.downloadLabel {/*position: absolute; right: 10px; */font-size:14px; font-family:AxelRegular; color:#eee;}
.contractMeLabel {/*position: absolute; right: 10px; */font-size:14px; font-family:AxelRegular; color:#eee;}

</style>
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
		$titleString .= "<div id=\"header\">";
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

			$bodyHTMLString .= "<div class=\"cell\">";

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
			$bodyHTMLString .= "<img class=\"detailButton\" src=\"Images/DetailButtonHorizontal.png\"/>";		

			//Change Log
			$bodyHTMLString .= "<div style=\"height:21px;\">";
			$bodyHTMLString .= "<p class=\"changeLogTitle\">Change Log:</p>";
			$bodyHTMLString .= "</div>";
			$bodyHTMLString .= "<div style=\"word-break: break-all; word-wrap:break-word;\">";
			$bodyHTMLString .= "<div class=\"dymain\">";
			$bodyHTMLString .= "<table>";
			$bodyHTMLString .= "<tr>";
			$bodyHTMLString .= "<td>";
			$bodyHTMLString .= "<p style=\"font-family: AxelBold; color: #333333; font-size: 16px; padding-left:12px; padding-right:12px; padding-top:3px;\">$changeLog</p>";
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

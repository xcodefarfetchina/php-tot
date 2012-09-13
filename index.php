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
h1 {margin:0; padding:0; font-size:13px;text-align:center;}
/*普通Label默认属性*/
p {font-size:13px;}

/*顶部NavigationBar布局*/
#header {height:38px; background-image:url(Images/HeaderTitle.png);  margin:0 auto;}
/*顶部Title*/
.headerTitle {padding-top: 8px;font-size:16px; font-family:AxelRegular; color:#252525; text-shadow: 0px 1px 0px #fff;}

/*cell布局*/
.cell {background:#f3f3f3; height: 89px; border-top:0px solid #fff; border-bottom:1px solid #d3d3d3; margin-top: 0px}
.cell a {text-decoration:none; height:89px; font-size:15px; display:block; color:#000;}

/*Icon Container*/
.iconContainer {padding-left: 16px; padding-top: 16px; width: 57px; height: 57px}
/*Icon*/
.iconImage {width: 57px; height: 57px}
/*Icon Rounded Rect*/
.iconRoundedRectImage {margin-left: 0px; margin-top: -57px; width: 57px; height: 57px}
/*Detail Button*/
.detailButton {width: 9px; height: 15px; margin-top: -36px; position:absolute;right:10px;}

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
/*MoreButtonButton*/
.moreButton { width: 65px; height: 24px; margin-top: -37px; position: absolute; right: 40px;}
.moreButton a {width: 65px; height: 24px; padding-top: 16px; padding-left: 10px; padding-right: 10px}

.errorLabel	{padding-top: 108px;font-size:16px; font-family:AxelRegular; color:#fff;}

</style>
</head>
<body>

<!-- 顶部NavigationBar -->
<div id="header">
	<h1 class="headerTitle">Install Apps</h1>
</div>

<?php
	require 'Classes/TOTClasses/GetVersionList.php';
	require 'Classes/TOTClasses/GetRootURL.php';
	$versionArray = allList();
	$error = $versionArray['error'];
	if ($error === "OK")
	{
		$serverRootURL = getRootURL();
		foreach ($versionArray["VersionInfo"] as $key => $value)
		{
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

			echo "<div class=\"cell\">";
			echo "<a href=\"itms-services://?action=download-manifest&url=$manifestURL\">";
				echo "<div class=\"iconContainer\">";
					echo "<img class=\"iconImage\" src=\"$imagePath\"/>";
					echo "<img class=\"iconRoundedRectImage\" src=\"Images/RoundedRectAngel.png\"/>";
				echo "</div>";
				echo "<div class=\"labelOuterContentView\">";
					echo "<div class=\"labelInnerContentView\">";
						echo "<p class=\"cellTitleLabel\">$title $version</p>";
						echo "<p class=\"cellVersionLabel\">#$betaVersion</p>";
						echo "<p class=\"cellDateLabel\">$dateString</p>";
					echo "</div>";
				echo "</div>";
				echo "<img class=\"detailButton\" src=\"Images/DetailButton.png\"/>";
			echo "</a>";
			echo "</div>";
			if ($value["HasMoreBetaVersion"] === true)
			{
				echo "<div class=\"moreButton\">";
					echo "<a href=\"http://www.baidu.com\"><img width = 65px; height=24px; src=\"Images/MoreButton.png\"/></a>";
				echo "</div>";
			}
		}
	}
	else
	{
		echo "<h1 class=\"errorLabel\">$error</h1>";
	}
?>

</body>
</html>

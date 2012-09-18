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

<link rel="apple-touch-startup-image" href="Images/Default.png" media="(device-width: 320px)" sizes="320x640"/>
<link rel="apple-touch-startup-image" href="Images/Default@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" sizes="640x920"/>
<link rel="apple-touch-startup-image" href="Images/Default-568h@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" sizes="640x1096"/>

<link href="Images/DefaultIpadPortrait.png" media="(device-width: 768px) and (orientation: portrait)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadPortrait@2x.png" media="(device-width: 768px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadLandscape.png" media="(device-width: 768px) and (orientation: landscape)" rel="apple-touch-startup-image"/>
<link href="Images/DefaultIpadLandscape@2x.png" media="(device-width: 768px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image"/>

<title>TOT</title>
</head>

<SCRIPT LANGUAGE="JScript">
function openPage(location)
{
    document.location=(location);
}
</SCRIPT>

<body>

<!-- 顶部NavigationBar -->
<div class="navigationBar">
	<h1 class="headerTitle">Install Apps</h1>
</div>

<!-- 以上是Header -->

<?php
	
	/*	
	Created by Open Fibers
	25'O Clock Inc.
	Sep 9 2012
	 */
	require 'Classes/TOTClasses/GetVersionList.php';
	require 'Classes/TOTClasses/GetRootURL.php';
	$versionArray = allList();
	$error = $versionArray['error'];
	if ($error === "OK")
	{
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
			//Icon
			$imagePath = $value['ImagePath'];
			if (!$imagePath || $imagePath === "")
			{
				$imagePath = "Images/Icon.png";
			}
			//ipa详情页
			$detailURL =
			 "ipadetail.php?identifier=" . $value["BundleIdentifier"] . 
			 "&betaversion=" . $value["BetaVersion"] .
			 "&backuri=" . "index.php";

			echo "<div class=\"cell\" onclick=\"openPage('$detailURL')\">";
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
			echo "</div>";
			if ($value["HasMoreBetaVersion"] === true)
			{
				$moreVersionURL = "moreversions.php?identifier=" . $value["BundleIdentifier"];
				echo "<div class=\"moreButton\" onclick=\"openPage('$moreVersionURL')\">";
					echo "<img width = 65px; height=24px; src=\"Images/MoreButton.png\"/>";
				echo "</div>";
			}
		}
	}
	else
	{
		echo "<h1 class=\"errorLabel\">$error</h1>";
	}
?>

<!-- 以下是Footer -->

<div style="height:88px;"> 
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


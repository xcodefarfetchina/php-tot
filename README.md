#Intruduction

##What's TOT?

TOT is a solution includes:  
1. A server that you can upload your beta test ipa packages to. We call it "TOT server".  
2. A web app that you can download the uploaded ipa packages from TOT server directly to your iOS devices.  
   The downloaded ipa will be installed to your device.

It is created by php and uses apple OTA technology.

##Then what's OTA?

OTA stands for over-the-air. With this technology, you can install beta test ipa packages to iOS devices via wifi, and USB cable is not required any more.

##Why TOT?
There are several ways to achieve OTA installation. However, TOT is the most convenient way to build a OTA server, and the most convenient way to release beta test ipa package.   

1.Imagine your developing iOS project needs a beta test. There are 20 test engineers of this large project.You just need to send them your TOT server's URL. No e-mail ipa attachments. No USB cable installation.
  
2.Imagine you are developing a new version of your iOS app. You have 3 team mates, each one develops a prototype, so there are 4 prototypes your boss can choose from. You upload four ipa packages to TOT server. Your boss opened TOT server's URL in mobile safari, and he can install every version conveniently.

3.Imagine your investment is in another country, and wants to see the progress of your developing iOS app. You just mail him your TOT server's URL. He opens the URL in his mobile Safari, the download and installation begins magically. The download speed depends on your server's network speed and is likely much more faster than App Store's download speed.

#How to use TOT?
##Prepare a TOT server
1.Prepare an php server. Make sure running PHP5 on it.  
  For example, I use an Apache2.2.21 running PHP 5.3.8.  

2.Check server's upload settings. In Apache, open php.ini, check settings of 'upload_max_filesize' and 'post_max_size'. I set both of them 200M, so I can upload ipa files whose size are less than 200MB.  

3.Download php-tot from github. Copy php-tot folder to your PHP server. For example, I'm using a MAC, Apache server's documents path is '/Library/WebServer/Documents'. I copy php-tot to '/Library/WebServer/Documents'

##Upload ipa packages
1.Open TOT server's URL in your MAC/PC's browser. For example, mine PHP server's address is 192.168.1.103, so I opened 'http://192.168.1.103/php-tot/upload' in Chrome. You may upload php-tot to a server which has a domain.  
  
2.Click 'Choose File', then choose an illegal beta test ipa. Type some change log of this version, then click 'Submit'。

##Installation on mobiles
1.Open TOT server's URL in your mobile Safari, mine is 'http://192.168.1.103/php-tot'. You can add this page to iOS device's home screen. It looks like this:  
![TOT server list](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot1.png?raw=true "Choose ipa from TOT server")

2.Choose a product, then the detail page of this product shows. Touch "Install" button. Then the installation will begin. Very convenient, isn't it?  
![TOT server ipa detail](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot2.png?raw=true "Ipa detail from TOT server")
![TOT server installation](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot3.png?raw=true "Install ipa from TOT server")

#Todo
1.User interface to let developers delete uploaded ipa.  
2.Upload and delete permission control.  
  

#简体中文 盒装正版 介绍

##什么是TOT?

TOT是一套完整的OTA解决方案，它包括:  
1. Ipa安装包上传与自动部署服务器. 我们称之为"TOT server"。  
2. 一个用来在iPhone/iPad/touch上查看ipa简介、安装ipa的webapp。

TOT使用PHP实现，使用苹果的OTA技术。

##什么是苹果的OTA技术?

OTA的意思是over-the-air。有了它，你可以在iOS的Safari上直接下载安装测试ipa，告别USB数据线，告别邮件附件。

##为什么要用TOT?
OTA已经有了为数不多的几种良好封装。 但创建OTA服务器、发布测试ipa安装包，TOT是最方便的方式。   

1.Imagine your developing iOS project needs a beta test. There are 20 test engineers of this large project.You just need to send them your TOT server's URL. No e-mail ipa attachments. No USB cable installation.
  
2.Imagine you are developing a new version of your iOS app. You have 3 team mates, each one develops a prototype, so there are 4 prototypes your boss can choose from. You upload four ipa packages to TOT server. Your boss opened TOT server's URL in mobile safari, and he can install every version conveniently.

3.Imagine your investment is in another country, and wants to see the progress of your developing iOS app. You just mail him your TOT server's URL. He opens the URL in his mobile Safari, the download and installation begins magically. The download speed depends on your server's network speed and is likely much more faster than App Store's download speed.

#如何使用?
##准备一个TOT server
1.准备一个可以运行PHP5服务器.我用的是Apache2.2.21和PHP 5.3.8.  

2.检查服务器的上传设置。如果你也用Apache的话，打开php.ini，检查'upload_max_filesize'和'post_max_size'两个值的设置。我把这两个值都设置成了200M，所以我可以向我的TOT server上传200M以内的ipa。  

3.下载php-tot从github。把php-tot文件夹复制到你的PHP服务器。我的MAC中Apache服务器的文件路径是'/Library/WebServer/Documents'，所以我把php-tot复制到了'/Library/WebServer/Documents'下面。

##上传ipa安装包
1.在你MAC/PC的浏览器中打开TOT server的URL。 我的Apache的地址是192.168.1.103，所以我在Chrome中打开'http://192.168.1.103/php-tot/upload'。你也可以准备一台带域名的服务器。  
  
2.点击'Choose File', 然后选择一个合法的ipa测试安装包。写点此次发布的Change log，然后点击'Submit'。

##安装到手机
1.在iPhone/iPad的Safari里打开TOT server的URL，我的是'http://192.168.1.103/php-tot'。 你可以把这个页面添加到主屏幕。页面如下:  
![TOT server list](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot1.png?raw=true "Choose ipa from TOT server")

2.选择一个想要安装的产品，页面将会跳转到此产品的详情页。点击"Install"按钮，安装就会开始。是不是很方便？  
![TOT server ipa detail](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot2.png?raw=true "Ipa detail from TOT server")
![TOT server installation](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot3.png?raw=true "Install ipa from TOT server")

#Todo
1.增加删除已上传测试包的UI。  
2.增加上传和删除的权限管理。  
#Intruduction

##What's TOT?

TOT is a solution includes:  
1. A server that you can upload your beta test ipa packages to. We call it "TOT server".  
2. A web app that you can download the uploaded ipa packages from TOT server directly to your iOS devices.  
   The downloaded ipa will be installed to your device. Full compatible with iPhone5.

It is created by php and uses apple OTA technology.

##Then what's OTA?

OTA stands for over-the-air. With this technology, you can install beta test ipa packages to iOS devices via wifi, and USB cable is not required any more. It wirelessly improve ad-hoc distribution.

##Why OTA?
There are several ways to achieve OTA installation. However, TOT is the most convenient way to build a OTA server, and the most convenient way to release beta test ipa package.   

1.Imagine your developing iOS project needs an alpha test. There are 20 test engineers of this large project.You just need to send them your TOT server's URL. No e-mail ipa attachments. No USB cable installation.
  
2.Imagine you are developing a new version of your iOS app. You have 3 team mates, each one develops a prototype, so there are 4 prototypes your boss can choose from. You upload four ipa packages to TOT server. Your boss opened TOT server's URL in mobile safari, and he can install every version conveniently.

3.Imagine your investment is in another country, and wants to see the progress of your developing iOS app. You just mail him your TOT server's URL. He opens the URL in his mobile Safari, the download and installation begins magically. The download speed depends on your server's network speed and is likely much more faster than App Store's download speed.
  
##Features
1.No database required. Simple file and directory storage.  
2.Dynamic manifest technology.  
3.Beautiful web app for install. Compatible with iPhone5.  
4.Easy to do server migration.
  Just copy php-tot and paste it to another server. Data in it won't be damaged.

#How to use TOT?
##Prepare a TOT server
1.Prepare an php server. Make sure running PHP5.3 or higher version on it.  
  For example, I use an Apache2.2.21 running PHP 5.3.8.  

2.Check server's upload settings. In Apache, open php.ini, check settings of 'upload_max_filesize' and 'post_max_size'. I set both of them 200M, so I can upload ipa files whose size are less than 200MB.  

3.Download php-tot from github. Copy php-tot folder to your PHP server. For example, I'm using a MAC, Apache server's documents path is '/Library/WebServer/Documents'. I copy php-tot to '/Library/WebServer/Documents'

4.Change file permission for php-tot.  
  For example, in my mac, Apache server's user is _www, _www's group is wheel. php-tot be copied to '/Library/WebServer/Documents'. Open Terminal and type these commands.  
    cd /Library/WebServer/Documents  
    sudo chown _www:wheel php-tot  

##Upload ipa packages
1.Open TOT server's URL in your MAC/PC's browser. For example, mine PHP server's address is 192.168.1.103, so I opened 'http://192.168.1.103/php-tot/upload' in Chrome. You may upload php-tot to a server which has a domain.  
  
2.Click 'Choose File', then choose an illegal beta test ipa. Type some change log of this version, then click 'Submit'。

##Installation on mobiles
1.Open TOT server's URL in your mobile Safari, mine is 'http://192.168.1.103/php-tot'. You can add this page to iOS device's home screen. It looks like this:  
![TOT server list](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot1.png?raw=true "Choose ipa from TOT server")

2.Choose a product, then the detail page of this product shows. Touch "Install" button. Then the installation will begin. Very convenient, isn't it?  
![TOT server ipa detail](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot2.png?raw=true "Ipa detail from TOT server")
![TOT server installation](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot3.png?raw=true "Install ipa from TOT server")

#License
php-tot is published under the [MIT License](http://www.opensource.org/licenses/mit-license.php).  
  
php-tot uses [CFPropertyList](https://github.com/rodneyrehm/CFPropertyList).  
[CFPropertyList](https://github.com/rodneyrehm/CFPropertyList) is under The [MIT License](http://www.opensource.org/licenses/mit-license.php). Copyright (c) 2009 Christian Kruse, Rodney Rehm

#Todo
1.User interface to let developers delete uploaded ipa.  
2.Upload and delete permission control.  
  
#Other choice

Web Service:  
1.[Test Flight](http://testflightapp.com)  
2.[diawi](http://www.diawi.com)  
3.[AppSendr](http://www.appsendr.com)  
4.[HockeyApp](http://www.hockeyapp.net)  
  
Open Sourced project:  
1.[HockeyKit](https://github.com/TheRealKerni/HockeyKit) : Open sourced PHP5 project.  
2.[BetaBuilder for iOS](http://www.hanchorllc.com/betabuilder-for-ios/) : Open sourced native MAC app. It should be used with a static web server.  

#简体中文 盒装正版 介绍

##什么是TOT?

TOT是一套完整的OTA解决方案，它包括:  
1. Ipa安装包上传与自动部署服务器. 我们称之为"TOT server"。  
2. 一个用来在iPhone/iPad/touch上查看ipa简介、安装ipa的webapp。已兼容iPhone5的新分辨率。

TOT使用PHP实现，使用苹果的OTA技术。

##什么是苹果的OTA技术?

OTA的意思是over-the-air。有了它，你可以在iOS的Safari上直接下载安装测试ipa，告别USB数据线，告别邮件附件。

##为什么要用OTA?
OTA已经有了为数不多的几种良好封装。 但创建OTA服务器、发布测试ipa安装包，TOT是最方便的方式。   

1.设想你将要为正在进行的iOS工程开始内测。你正在进行的大工程需要20个测试工程师（我知道这在天朝不现实）。你只需要把TOT server的URL发给他们，不需要给每个人都发送一个带ipa附件的邮件，也不需要插线安装。
  
2.摄像你正在开发一个App的新版本。你有3个iOS开发工程师同事，每个人开发一种原型，以便让你们的老板从四个原型中挑一种最好的。你们把ipa安装包都上传到TOT server。你的老板在iPhone上打开TOT server的URL，只需要手指点点就可以选择他想看的原型。  

3.设想你的投资人在另一个国家，他想看看你们的iOS app开发的怎么样了。你只管把TOT server的URL发给他，他在iPhone上打开了这个URL，只需轻点两下，安装就可以开始了。而且你服务器带宽好的话，从自己的TOT server下载ipa比从App Store下要快很多。
  
##特点
1.无需任何数据库，单纯文件存储；  
2.动态manifest技术，好处参见第4条；  
3.优雅的web app安装界面，让你在测试、风投、其他屌丝码农面前辈儿有面子；完美兼容iPhone5；  
4.可以无痛服务器迁移。只要把php-tot复制粘贴到另一个服务器就好，数据毫发无伤。

#如何使用?

##致天朝的程序员们
Copyright (c) 2012, Open Fibers  
All rights reserved.  
再分发源代码或使用二进制形式再分发php-tot，修改或不做修改，都需满足下列条件：  
再分发源代码时必须保留上述版权声明，此条件列表和以下免责声明。  
以二进制形式进行再分发必须复制上述版权声明，此条件列表和下面的免责声明中的文档和/或其他材料的分布。  
"Open Fibers"的名称，和php-tot的贡献者的名字，都不可用于认可或推广未经事先书面许可，由本软件衍生的产品。  
本软件是由版权所有者和贡献者提供，但并不提供任何明示或暗示的担保，包括但不限于针对特定用途的适销性和适用性的暗示担保担保。在任何情况下，著作权人都不承担任何直接的，间接的，附带的，特殊的，惩罚性的或后果性的损失。无论起因是任何理论责任。

##准备一个TOT server
1.准备一个可以运行PHP5.3或以上版本的服务器.我用的是Apache2.2.21和PHP 5.3.8.  

2.检查服务器的上传设置。如果你也用Apache的话，打开php.ini，检查'upload_max_filesize'和'post_max_size'两个值的设置。我把这两个值都设置成了200M，所以我可以向我的TOT server上传200M以内的ipa。  

3.下载php-tot从github。把php-tot文件夹复制到你的PHP服务器。我的MAC中Apache服务器的文件路径是'/Library/WebServer/Documents'，所以我把php-tot复制到了'/Library/WebServer/Documents'下面。  
  
4.更改php-tot的文件权限  
  举例说明：在我的MAC中，Apache服务器的用户是_www， _www所属用户组是wheel。php-tot已被复制到'/Library/WebServer/Documents'。打开命令行，敲下以下命令  
    cd /Library/WebServer/Documents  
    sudo chown _www:wheel php-tot  

##上传ipa安装包
1.在你MAC/PC的浏览器中打开TOT server的URL。 我的Apache的地址是192.168.1.103，所以我在Chrome中打开'http://192.168.1.103/php-tot/upload'。你也可以准备一台带域名的服务器。  
  
2.点击'Choose File', 然后选择一个合法的ipa测试安装包。写点此次发布的Change log，然后点击'Submit'。

##安装到手机
1.在iPhone/iPad的Safari里打开TOT server的URL，我的是'http://192.168.1.103/php-tot'。 你可以把这个页面添加到主屏幕。页面如下:  
![TOT server list](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot1.png?raw=true "Choose ipa from TOT server")

2.选择一个想要安装的产品，页面将会跳转到此产品的详情页。点击"Install"按钮，安装就会开始。是不是很方便？  
![TOT server ipa detail](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot2.png?raw=true "Ipa detail from TOT server")
![TOT server installation](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot3.png?raw=true "Install ipa from TOT server")

#License
php-tot is published under the [MIT License](http://www.opensource.org/licenses/mit-license.php).  
  
php-tot uses [CFPropertyList](https://github.com/rodneyrehm/CFPropertyList).  
[CFPropertyList](https://github.com/rodneyrehm/CFPropertyList) is under The [MIT License](http://www.opensource.org/licenses/mit-license.php). Copyright (c) 2009 Christian Kruse, Rodney Rehm

#Todo
1.增加删除已上传测试包的UI。  
2.增加上传和删除的权限管理。  
  
#其他OTA选择

Web Service:  
1.[Test Flight](http://testflightapp.com)  
2.[diawi](http://www.diawi.com)  
3.[AppSendr](http://www.appsendr.com)  
4.[HockeyApp](http://www.hockeyapp.net)  
  
开源项目:  
1.[HockeyKit](https://github.com/TheRealKerni/HockeyKit) : 开源项目，同样使用PHP5.  
2.[BetaBuilder for iOS](http://www.hanchorllc.com/betabuilder-for-ios/) : 开源项目，是一个MAC app，需一个静态web服务器配合使用.  


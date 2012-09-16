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

#How to use OTA?
##Prepare a TOT server
1.Prepare an php server. Make sure running PHP5 on it.  
  For example, I use an Apache2.2.21 running PHP 5.3.8.  

2.Check server's upload settings. In Apache, open php.ini, check settings of 'upload_max_filesize' and 'post_max_size'. I set both of them 200M, so I can upload ipa files whose size are less than 200MB.  

3.Download php-tot from github. Copy php-tot folder to your PHP server. For example, I'm using a MAC, Apache server's documents path is '/Library/WebServer/Documents'. I copy php-tot to '/Library/WebServer/Documents'

##Upload ipa packages
1.Open TOT server's URL in your MAC's browser. For example, mine PHP server's address is 192.168.1.103, so I opened 'http://192.168.1.103/php-tot/upload' in Chrome. You may upload php-tot to a server which has a domain.  
  
2.Open 'Choose File', then choose an illegal beta test ipa. Type some change log of this version, then click 'Submit';

##Installation on mobiles
1.Open 'http://192.168.1.103/php-tot' in your mobile Safari. You can add this page to iOS device's home screen. It looks like this:  
![TOT server list](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot1.png?raw=true "Choose ipa from TOT server")

2.Choose a product, then the detail page of this product shows. Touch "Install" button. Then the installation will begin. Very convenient, isn't it?  
![TOT server ipa detail](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot2.png?raw=true "Ipa detail from TOT server")
![TOT server installation](https://github.com/OpenFibers/php-tot/blob/master/ScreenShots/ScreenShot3.png?raw=true "Install ipa from TOT server")

#Todo
1.User interface to let developers delete uploaded ipa.  
2.Upload and delete permission control.  
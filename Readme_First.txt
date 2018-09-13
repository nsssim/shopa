,.-~*´¨¯¨`*·~-.¸-(_Installation_)-,.-~*´¨¯¨`*·~-.¸

1.upload all the files to the server (or clone project via git)

2.rename .htaccess.sample to .htaccess

3. edit .htaccess and change
	RewriteRule ^(.*)$ /usa/index.php/$1 [L] 
	to 
	RewriteRule ^(.*)$ /project_directory/index.php/$1 [L] 

4. import sql file to your MySQL server (mysql -u user_name db_name < file.sql)
	
5.go to /application/config/
	rename config.php.sample to config.php and edit $config['base_url'] = "http://www.domain_name.com/project_directory/";
	rename database.php.sample to database.php and edit 
	$db['default']['username'] = 'user_name';
	$db['default']['password'] = 'XXXX';
	$db['default']['database'] = 'db_name';
	

6.rename constants.php.sample to constants.php
	you can enable or desable the cache like so:
	define('CACHE_IS_ON',0); // cache desabled
	define('CACHE_IS_ON',1); // cache enabled (you must install redis server if you want to enable it)


,.-~*´¨¯¨`*·~-.¸-(_CRONTAB_)-,.-~*´¨¯¨`*·~-.¸

Cron is a unix, solaris utility that allows tasks to be automatically run in the background at regular intervals by the cron daemon.

this project uses Cron for :
	1.sending orders statuses emails every 1 hour 
	2.updating its categories every day

make sure you add the following lines (don't forget to modify the domain name + project_directory) to cron on a unix like operating system :
Note : make sure you have lynx installed on your os http://lynx.browser.org/ you can also use WGET instead of lynx 
CRONTAB CODE

SHELL=/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root

# For details see man 4 crontabs

# Example of job definition:
# .---------------- minute (0 - 59)
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name  command to be executed
#every hour
# 00 * * * * root lynx -dump http://www.shopamerika.com/beta/autorun/test

#send emails at every 15th,16th,17th minute past every hour (example 1:15, 2:15 ...etc) 
#output location : /home/shopamerika/public_html/beta/data/logs/orders_emails.html 
15 * * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/send_orders_in_warehouse_pending_emails
16 * * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/send_orders_is_shipped_pending_emails
17 * * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/send_orders_is_delivered_pending_emails

#synch categories table at 1 AM 
#output location : /home/shopamerika/public_html/beta/data/logs/category_synch_log.html
00 1 * * * root /usr/bin/lynx -dump http://www.shopamerika.com/beta/autorun/category_synch


,.-~*´¨¯¨`*·~-.¸-(_REDIS_)-,.-~*´¨¯¨`*·~-.¸

Redis is an in-memory data structure store, used as database, cache and message broker.

This project uses Redis as a cache server, make sure you install redis on your server, if you want to enable tha cache.
Read this article to install redis server on CentOS 7 / RHEL 7
http://sharadchhetri.com/2014/10/04/install-redis-server-centos-7-rhel-7/

Sometime Redis craches , to fix the common problem just restart Redis by typing this command in your shell

systemctl restart redis.service

Redis Documentation can be found here http://redis.io/documentation

,.-~*´¨¯¨`*·~-.¸-(_SSH2LIB_)-,.-~*´¨¯¨`*·~-.¸

SSH2LIB is a library that allows php tp connect to ssh server and use commands. this project makes use of this library to 
do some stuff from admin panel those are the steps to follow on Centos 7 :

# yum update
# yum install  make gcc  libssh2  php-devel php-pearlibssh2-devel
# yum install libssh2-devel
# pecl install -f ssh2
# echo "extension=ssh2.so" >  /etc/php.d/ssh2.ini
# /sbin/service httpd restart
# php -m | grep ssh2

please read this article for more details 
http://thelinuxfaq.com/253-how-to-install-ssh2-extension-for-php-rhel-centos-7

and this also helped to solve the "error checking for ssh2 files in default path... not found configure: error: The required libssh2 library was not found"
http://stackoverflow.com/questions/561024/install-pecl-ssh2-extension-for-php


,.-~*´¨¯¨`*·~-.¸-(_7h4nk y0u_)-,.-~*´¨¯¨`*·~-.¸

To all those who contributed to acchieve this project by code and support !


#!/bin/sh
git pull
mv  /home/u706997718/public_html/index.php index.php.saved
rm -rf /home/u706997718/public_html/*
# update project/ to your directory name
cp -a /home/u706997718/public/* /home/u706997718/public_html
cp /home/u706997718/public/.htaccess  /home/u706997718/public_html
rm -rf  /home/u706997718/public_htm/index.php
mv index.php.saved  /home/u706997718/public_html/index.php
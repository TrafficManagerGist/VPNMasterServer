#!/bin/bash
wget https://raw.githubusercontent.com/TrafficManagerGist/VPNMasterServer/main/config.json -P /var/
wget https://raw.githubusercontent.com/TrafficManagerGist/VPNMasterServer/main/index.php -P /var/www/html/

sudo apt-get update
sudo apt-get install apache2
sudo apt-get install php libapache2-mod-php php-mysql
sudo systemctl reload apache2
exit 0
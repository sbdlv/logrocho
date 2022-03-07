#!/bin/bash

# HTDOCS
unzip /home/server_logrocho/logrocho.zip -d /var/www/html/

#DB
mysql --user=logrocho --password=logrocho < logrocho.sql



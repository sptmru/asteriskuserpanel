<?php
header("Content-Type: text/html; charset=utf-8");

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'userpanel');
define('MYSQL_PASSWORD', 'ReBnWzxxdJwGwa3w');
define('MYSQL_DB', 'userpanel');


define('TRUNK_HOST', '127.0.0.1');  //Trunks server
define('TRUNK_FILE', '/etc/asterisk/sip_panel.conf'); //you have to create this file before using

define('AMI_HOST', '127.0.0.1'); //Asterisk server
define('AMI_PORT', '5038');
define('AMI_USER', 'admin');
define('AMI_PASSWORD', 'amp111');

define('NUMBER_PREFIX', ''); //prefix to add in front of number in register string, by default is empty


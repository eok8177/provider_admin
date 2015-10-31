<?php
include ('/var/www/admin.page');

if (!(isset($_SERVER[PHP_AUTH_USER]) && isset($_SERVER[PHP_AUTH_PW]))) {
    header("WWW-Authenticate: Basic realm=\"Admin Page\"");
    header("HTTP/1.0 401 Unauthorized");
    echo '<a href="/">Home</a>';
    exit;
    } 

else {$pass=md5(trim($_SERVER[PHP_AUTH_PW])); $user=md5(trim($_SERVER[PHP_AUTH_USER]));

    if ($pass==md5(trim($PASSWORD)) && $user==md5(trim($LOGIN))) {include ("/var/www/admin/index.php");}

    else {
	    header("WWW-Authenticate: Basic realm=\"Admin Page\"");
	    header("HTTP/1.0 401 Unauthorized");
	    exit;
	 }
    }

?>
		
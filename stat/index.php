<?

require ("/var/www/html/header");
if (isset($mod)){
		if ($mod==="dial"){include ("/var/www/stat/1.php");}
		elseif ($mod==="game"){include ("/var/www/stat/0.php");}
		elseif ($mod==="legion"){include ("/var/www/stat/lan.php");}
		
		elseif ($mod==="stat"){
                        if ($passwd==="dial"){include ("/var/www/stat/dial_stat.php");}
		elseif ($passwd==="test"){include ("/var/www/stat/home_stat.php");}		
		else {include ("index_body");}     }
		
		
		else {include ("index_body");}
		
} else {include ("index_body");}

require ("/var/www/html/footer");

?>

<?

require ("header");

if (isset($mod)){
    if ($mod==="serv"){include ("serv_body");} 
    elseif ($mod==="stat"){
			if ($passwd==="dial"){include ("/var/www/stat/dial_stat.php");}
			elseif ($passwd==="test"){include ("/var/www/stat/home_stat.php");}  
			else {include ("index_body");}

		     } else {include ("index_body");}
		} else {include ("index_body");}

require ("footer");

?>

<?

require ("/var/www/admin/header");

if (isset($mod)){
                    if ($mod==="all_dial")  {include ("/var/www/admin/all_dial.php");}
	        elseif ($mod==="dial")      {include ("/var/www/admin/dial.php");}
	        elseif ($mod==="all_home")  {include ("/var/www/admin/all_home.php");}
	        elseif ($mod==="home")      {include ("/var/www/admin/home.php");}			
	        elseif ($mod==="pay")       {include ("/var/www/admin/pay.php");}						
	        elseif ($mod==="traff")     {include ("/var/www/admin/traff.php");}						
	        elseif ($mod==="dial_stat") {include ("/var/www/admin/dial_stat.php");}									
	        elseif ($mod==="home_stat") {include ("/var/www/admin/home_stat.php");}
	        elseif ($mod==="edit")	    {include ("/var/www/admin/edit.php");}
	        elseif ($mod==="lan")	    {include ("/var/www/admin/lan.php");}		
	        
		else {include ("/var/www/admin/online.php");}

} else {include ("/var/www/admin/online.php");}

require ("/var/www/admin/footer");

?>

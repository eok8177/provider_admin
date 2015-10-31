<?php
require("/var/www/dbm_10.1");
mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM users";
$query = mysql_query($sql) or die ("Query error");

echo "<table border=1 width100 bgcolor=gold>\n";
echo "<tr><td>ID</td><td width=30>Login</td><td width=20>Счет</td><td width=50>Абон плата</td><td>группа</td></tr>\n";


for ($i=0; $i<mysql_num_rows($query); $i++)
 {
  echo "<tr>";
  
  $s=mysql_fetch_array($query);

  echo "<td>$s[Id]</td><td>$s[name]</td><td>$s[acct]</td><td>$s[abonplata]</td><td>$s[groupe]</td>";
  
  echo "</tr>\n";
 }

echo "</table>";

?>

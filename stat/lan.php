<?php
require("/var/www/dbm_0.10");
mysql_select_db($DB2) or die("No Select DB");

$year=date(Y); $mon=date(m);$day=date(d);
$curdate = date("Y-m-d H:i:s");

$sql ="SELECT * FROM users WHERE name='legion'";
$query = mysql_query($sql) or die ("Query error");

echo "<table border=1 bgcolor=gold>\n";
echo "<tr><td width=30>Name</td><td width=100>Account</td></tr>\n";

  echo "<tr>";
  
  $s=mysql_fetch_array($query);

  echo "<td>$s[name]</td><td>$s[acct]</td>";
  
  echo "</tr>\n";

echo "</table>";

echo "<br><img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=legion\"><br><br>";

?>

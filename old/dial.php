<?php

require("/var/www/dbm_0.1");
mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM users ORDER BY id";
$query = mysql_query($sql) or die ("Query error");

echo "<table border=1 width=100% cellspacing=0>\n";
echo "<tr><td>ID</td><td>Логин</td><td>Группа</td><td>Счёт</td><td>Limit</td><td>Доступ</td><td>Фамилия</td><td>Имя Отчество</td><td>Адресс</td><td>Телефон</td><td></td></tr>\n";

mysql_select_db($DB2) or die("No Select DB");

for ($i=0; $i<mysql_num_rows($query); $i++)
 {
  $s=mysql_fetch_array($query);

$sql1 ="SELECT last_name,name,street_home,phone,acct FROM users WHERE login='$s[login]'";
$info = mysql_query($sql1) or die ("Query2 error");
  $s1=mysql_fetch_array($info);


  echo "<tr>";

  $last_name=convert_cyr_string($s1[last_name], w, k);
  $name=convert_cyr_string($s1[name], w, k);
  $street_home=convert_cyr_string($s1[street_home], w, k);  

  echo "<td>$s[id]</td><td>$s[login]</td><td>$s[gr]</td><td>$s[acct]</td><td>$s[lim]</td><td>$s[access]</td><td>$last_name</td><td>$name</td><td>$street_home</td><td>$s1[phone]</td>";



echo "<form action=\"?mod=edit\" method=\"post\">";
echo "<input type=hidden name=edit_user value="; echo "$s[login]"; echo ">";

echo " <td align=\"center\"><input type=\"submit\" name=\"report\" value=\"Edit\" align=\"middle\"></td>";
 
echo "</form>";
  
  echo "</tr>\n";
 }

echo "</table>";

?>

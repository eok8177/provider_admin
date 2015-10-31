<?
  require("/var/www/dbm_0.10");
  mysql_select_db($DB1) or die("No Select DB");

  $sql ="SELECT * FROM online ORDER BY linkname";
  $query = mysql_query($sql) or die ("Query error");
?>

Online DialUp
<table border=1 bgcolor=gold>
<tr><td>Login</td><td>Вошел</td><td>время</td><td>отправил</td><td>принял</td><td>телефон</td><td>tty</td><td>Фамилия</td><td>Имя Отчество</td><td>Телефон</td></tr>

<?
  require("/var/www/dbm_0.1");
  mysql_select_db($DB2) or die("No Select DB");

  for ($i=0; $i<mysql_num_rows($query); $i++)
   {
    $s=mysql_fetch_array($query);

    $sql2 ="SELECT last_name, name, phone FROM users where login='$s[login]'";
    $query2 = mysql_query($sql2) or die ("Query error");
      $last_name=mysql_result($query2,0,0);  $last_name=convert_cyr_string($last_name, w, k);
      $name=mysql_result($query2,0,1); $name=convert_cyr_string($name, w, k);
      $phone=mysql_result($query2,0,2);    

    echo "<tr><td>$s[login]</td><td>$s[intime]</td><td>$s[connect_time]</td><td>$s[in_b]</td><td>$s[out_b]</td><td>$s[phone]</td><td>$s[linkname]</td><td>$last_name</td><td>$name</td><td>$phone</td></tr>";
   }
?>

</table>

<br>

Online Home


<table border=1 bgcolor=gold>
<tr><td>Login</td><td>Вошел</td><td>отправил</td><td>принял</td></tr>


<?
require("/var/www/dbm_10.1");
mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM current_sessions";
$query = mysql_query($sql) or die ("Query error");


for ($i=0; $i<mysql_num_rows($query); $i++)
{
echo "<tr>";

$s=mysql_fetch_array($query);

echo "<td>$s[name]</td><td>$s[start_time]</td><td>$s[in_b]</td><td>$s[out_b]</td>";

echo "</tr>\n";
 }
 
 ?>
 
 </table>
 <br><br>
 
<? include ("/var/www/adm/all.php"); ?>

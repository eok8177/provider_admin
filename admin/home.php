<?php

require("/var/www/dbm_10.1");
#require("S:\home\localhost\www\lokalnet\dbm_10.1");

if (!isset($check)) {$check=0;};
if (!isset($user)) {$user=0;};

##########################  Запись в БД  ######################################
if ($check==2){ 

# Входные переменные
#	abonplata
#	groupe
#	first_name
#	last_name
#	street
#	home
#	kvartira
#	phone
#	ip_addr

$first_name=convert_cyr_string($first_name, k, w);
$last_name=convert_cyr_string($last_name, k, w);
$street=convert_cyr_string($street, k, w);
$home=convert_cyr_string($home, k, w);
$kvartira=convert_cyr_string($kvartira, k, w);

mysql_select_db($DB1) or die("No Select DB");

    $sql0 ="UPDATE users_name SET first_name='$first_name',last_name='$last_name',street='$street',home='$home',kvartira='$kvartira',phone='$phone',ip_addr='$ip_addr'  WHERE name='$edit_user'";
    $query = mysql_query($sql0) or die ("Query error");	# Запись в таблицу описания

    $sql1 ="UPDATE users SET groupe='$groupe',abonplata='$abonplata'  WHERE name='$edit_user'";
    $query = mysql_query($sql1) or die ("Query error");	# Запись в основную таблицу

echo "Готово";

    };


########################  Вывод текущих значений для изменения ########################################
if ($check==1) {

mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM users WHERE name='$edit_user'";
	$query = mysql_query($sql) or die ("Query error");
	$s=mysql_fetch_array($query);
echo "$edit_user";
$sql1 ="SELECT * FROM users_name WHERE name='$s[name]'";
	$info = mysql_query($sql1) or die ("Query2 error");
	$s1=mysql_fetch_array($info);

$first_name=convert_cyr_string($s1[first_name], w, k);
$last_name=convert_cyr_string($s1[last_name], w, k);
$street=convert_cyr_string($s1[street], w, k);

echo "<table border=1 width100 bgcolor=gold>\n <tr>";
echo "<td>ID</td><td width=30>Login</td><td width=20>Счет</td><td width=50>Абон плата</td><td>группа</td><td>Фамилия</td><td>Имя</td><td>улица</td><td>дом</td><td>кв</td><td>тел</td><td>IP</td></tr>\n";
echo "<td>$s[Id]</td><td>$s[name]</td><td>$s[acct]</td><td>$s[abonplata]</td><td>$s[groupe]</td><td>$first_name</td><td>$last_name</td><td>$street</td><td>$s1[home]</td><td>$s1[kvartira]</td><td>$s1[phone]</td><td>$s1[ip_addr]</td>";
echo "</tr>";

?>

<tr><td></td><td></td><td></td>

<form action="?mod=home" method="POST">

<input type=hidden 	 name="check" 		value=2>
<input type=hidden  	 name="edit_user"	value="<? echo "$edit_user"; ?>">
<td><input type="text" name="abonplata"	size="4" value="<? echo "$s[abonplata]"; ?>">	</td>

<td><select name="groupe"><option value="<? echo "$s[groupe]"; ?>" selected><? if ($s[groupe]==1) {echo "По мегабайтная";}
											    if ($s[groupe]==2) {echo "Безлим 128";}
											    if ($s[groupe]==3) {echo "Безлим 64";} ?></option>
				<option value=1>По мегабайтная</option>
				<option value=3>Безлим 64</option>
				<option value=2>Безлим 128</option>
				<option value=4>Безлим 256</option>				
				<option value=5>Безлим 512</option>				
				<option value=10>Безлим 4MB</option>								
	</select> </td>

<td><input type="text" name="first_name"	size="16" value="<? echo "$first_name"; ?>">	</td>
<td><input type="text" name="last_name"	size="16" value="<? echo "$last_name"; ?>">	</td>
<td><input type="text" name="street"	size="16" value="<? echo "$street"; ?>">		</td> 
<td><input type="text" name="home"	size="4"   value="<? echo "$s1[home]"; ?>">	</td>
<td><input type="text" name="kvartira"	size="4"   value="<? echo "$s1[kvartira]"; ?>">	</td>
<td><input type="text" name="phone"	size="8"   value="<? echo "$s1[phone]"; ?>">	</td>
<td><input type="text" name="ip_addr"	size="15" value="<? echo "$s1[ip_addr]"; ?>">	</td>

</tr></table>
<input type="submit" name="report" value="Записать" align="middle">

</form>

</tr></table>


<? };


#########################  Вывод данных о пользователях #######################################
if ($check==0){ 

mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM users ORDER BY name";
$query = mysql_query($sql) or die ("Query error");

mysql_select_db($DB1) or die("No Select DB");

echo "<table border=1 width100 bgcolor=D0E3D3>\n <tr>";
echo "<td>ID</td><td width=30>Login</td><td width=20>Счет</td><td width=50>Абон плата</td><td>группа</td><td>Фамилия</td><td>Имя</td><td>улица</td><td>дом</td><td>кв</td><td>тел</td><td>IP</td></tr>\n";

for ($i=0; $i<mysql_num_rows($query); $i++) { # Вывод таблицы пользователей

   echo "<tr>";
  
  $s=mysql_fetch_array($query);


$sql1 ="SELECT * FROM users_name WHERE name='$s[name]'";
	$info = mysql_query($sql1) or die ("Query2 error");
	$s1=mysql_fetch_array($info);

$first_name=convert_cyr_string($s1[first_name], w, k);
$last_name=convert_cyr_string($s1[last_name], w, k);
$street=convert_cyr_string($s1[street], w, k);

#echo "$info";

if ($s[groupe]==1) {$gr= "MB";}
if ($s[groupe]==2) {$gr= "128";}
if ($s[groupe]==3) {$gr= "64";} 
if ($s[groupe]==4) {$gr= "256";} 
if ($s[groupe]==5) {$gr= "512";} 
if ($s[groupe]==10) {$gr= "4MB";} 

echo "<td>$s[Id]</td><td>$s[name]</td><td>$s[acct]</td><td>$s[abonplata]</td><td>$gr</td><td>$first_name</td><td>$last_name</td><td>$street</td><td>$s1[home]</td><td>$s1[kvartira]</td><td>$s1[phone]</td><td>$s1[ip_addr]</td>";
?>


<form action="?mod=home" method="post">
			<input type=hidden name=edit_user value="<? echo "$s[name]"; ?>"  >
			<input type=hidden name=check value=1>
<td align="center">	<input type="submit" name="report" value="Edit" align="middle"></td>
 
</form>
  
  </tr>


 <? }  echo "</table>";  }?>



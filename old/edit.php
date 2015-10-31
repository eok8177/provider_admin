<?php
require("/var/www/dbm_0.1");

# if (!isset($user)) {echo "error $user"; exit;}; echo "good $user";

 if (!isset($last_name)) {$last_name=0;};
 if (!isset($name)) {$name=0;}; 
 if (!isset($street_home)) {$street_home=0;};
 if (!isset($phone)) {$phone=0;};

if ($check==1){ 

#    echo "$last_name	$name	$street_home	$phone";

$last_name=convert_cyr_string($last_name, k, w);
$name=convert_cyr_string($name, k, w);
$street_home=convert_cyr_string($street_home, k, w);


#    echo "$last_name	$name	$street_home	$phone";
    mysql_select_db($DB2) or die("No Select DB");
    $sql0 ="UPDATE users SET last_name='$last_name',name='$name',street_home='$street_home',phone='$phone' WHERE login='$edit_user'";
    $query = mysql_query($sql0) or die ("Query error");
    };

mysql_select_db($DB1) or die("No Select DB");

$sql ="SELECT * FROM users WHERE login='$edit_user'";
$query = mysql_query($sql) or die ("Query error");
$s=mysql_fetch_array($query);

echo "<table border=1 width=100% cellspacing=0>\n";
echo "<tr><td>ID</td><td>Логин</td><td>Группа</td><td>Счёт</td><td>Limit</td><td>Доступ</td><td>Фамилия</td><td>Имя Отчество</td><td>Адресс</td><td>Телефон</td></tr>\n";

mysql_select_db($DB2) or die("No Select DB");
$sql1 ="SELECT last_name,name,street_home,phone,acct FROM users WHERE login='$s[login]'";
$info = mysql_query($sql1) or die ("Query2 error");
$s1=mysql_fetch_array($info);

echo "<tr>";

$last_name=convert_cyr_string($s1[last_name], w, k);
$name=convert_cyr_string($s1[name], w, k);
$street_home=convert_cyr_string($s1[street_home], w, k);

echo "<td>$s[id]</td><td>$s[login]</td><td>$s[gr]</td><td>$s[acct]</td><td>$s[lim]</td><td>$s[access]</td><td>$last_name</td><td>$name</td><td>$street_home</td><td>$s1[phone]</td>";

echo "</tr>\n";
?>


<tr><td></td><td></td><td></td><td></td><td></td><td></td>

<form action="?mod=edit" method="POST">

<input type=hidden name=check value=1>
<input type=hidden name=edit_user value="<? echo "$edit_user"; ?>">
<td><input type="text" name="last_name" size="16" value="<? echo "$last_name"; ?>"></td>
<td><input type="text" name="name" size="25" value="<? echo "$name"; ?>"></td> 
<td><input type="text" name="street_home" size="20" value="<? echo "$street_home"; ?>"></td>
<td><input type="text" name="phone" size="8" value="<? echo "$s1[phone]"; ?>"></td>

</tr></table>
<input type="submit" name="report" value="Записать" align="middle">

</form>

</tr></table>
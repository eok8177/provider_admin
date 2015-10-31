Загрузка модемов без учёта Unlimited

<TABLE cellpadding="2" cellspacing="0" border="1">
<TR><td>&nbsp</td><td>Ночь</td><td>День</td><td>Приняли</td><td>Отправили</td><td>Платежи</td><td>Счет</td></TR>

<?
if (!isset($mon)) {$mon=date("m");}
if (!isset($year)) {$year=date("Y");}

if ($mon==date("m")) {$cday=date("d");} else {$cday=30;}

$dat0=$year."-".$mon."-01 00:00:00";
$dat1=$year."-".$mon."-31 23:59:59";
$pdat0=$year."-".$mon."-01";
$pdat1=$year."-".$mon."-31";

require("/var/www/dbm_0.10");

mysql_select_db($DB1) or die("No Select DB");

$sql5="SELECT SUM(hour(time_zone1))+SUM(minute(time_zone1))/60+SUM(second(time_zone1))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1'";
$que5 = mysql_query($sql5) or die ("Query error 5");
$night=mysql_result($que5,0,0);

$sql6="SELECT SUM(hour(time_zone2))+SUM(minute(time_zone2))/60+SUM(second(time_zone2))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1'";
$que6 = mysql_query($sql6) or die ("Query error 6");
$day=mysql_result($que6,0,0);

$sql7="SELECT SUM(in_b)/1024/1024 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1'";
$que7 = mysql_query($sql7) or die ("Query error 7");
$in_b=mysql_result($que7,0,0);

$sql8="SELECT SUM(out_b)/1024/1024 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1'";
$que8 = mysql_query($sql8) or die ("Query error 8");
$out_b=mysql_result($que8,0,0);


require("/var/www/dbm_0.1");

mysql_select_db($DB2) or die("No Select DB");

$sql4="SELECT SUM(summ) FROM payment WHERE date BETWEEN '$pdat0' AND '$pdat1'";
$que4 = mysql_query($sql4) or die ("Query error 4");
$payment=mysql_result($que4,0,0);

mysql_select_db($DB1) or die("No Select DB");

$sql2 ="SELECT SUM(acct) FROM users";
$que2 = mysql_query($sql2) or die ("Query error");
$acct=mysql_result($que2,0,0);   

echo "<tr><td>Всего</td><td>$night ч</td><td>$day ч</td><td>$in_b М</td><td>$out_b М</td><td>$payment гр</td><td>$acct гр</td></tr>";

echo "</table>";

$zagr=($night+$day)/6/($cday*24)*100;
$zagr=round($zagr,0);
echo "Средняя загрузка за месяц: $zagr %";
?>



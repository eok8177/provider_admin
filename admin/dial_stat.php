<?
  if (!isset($login)) {$login="test";}
  if (!isset($mon)) {$mon=date("m");}
  if (!isset($year)) {$year=date("Y");}

  $curdate = date("d-m-Y H:i");
  $dat0=$year."-".$mon."-01 00:00:00";
  $dat1=$year."-".$mon."-31 23:59:59";
  $pdat0=$year."-".$mon."-01";
  $pdat1=$year."-".$mon."-31";

  require("/var/www/dbm_0.1");
  mysql_select_db($DB1) or die("No Select DB");

if ($year>2004 AND $year<2010 AND $mon>0 AND $mon<13){
$flag="NO";
$sql0 ="SELECT login FROM users";
$que0 = mysql_query($sql0) or die ("Query error");
for ($i=0; $i<mysql_num_rows($que0); $i++) {$s=mysql_fetch_array($que0); if ($s[login]==$login){$flag="OK";}}
if ($flag==="OK"){

  $sql1 ="SELECT id, acct FROM users WHERE login='$login'";
   $que1 = mysql_query($sql1) or die ("Query error");
   $user_id=mysql_result($que1,0,0);
   $acct=mysql_result($que1,0,1);

  mysql_select_db($DB2) or die("No Select DB");

  $sql3="SELECT * FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
   $que3 = mysql_query($sql3) or die ("Query error");

  $sql4="SELECT SUM(summ) FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
   $que4 = mysql_query($sql4) or die ("Query error");
   $payment=mysql_result($que4,0,0);

  require("/var/www/dbm_0.10");
  mysql_select_db($DB1) or die("No Select DB");

  $sql2 ="SELECT * FROM prim WHERE user_id='$user_id' AND intime BETWEEN '$dat0' AND '$dat1'";
   $que2 = mysql_query($sql2) or die ("Query error");

  $sql5="SELECT SUM(hour(time_zone1))+SUM(minute(time_zone1))/60+SUM(second(time_zone1))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que5 = mysql_query($sql5) or die ("Query error");
   $day=mysql_result($que5,0,0);

  $sql6="SELECT SUM(hour(time_zone2))+SUM(minute(time_zone2))/60+SUM(second(time_zone2))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que6 = mysql_query($sql6) or die ("Query error");
   $night=mysql_result($que6,0,0);
?>


<!------------------------------------------------------------------------------->
    <TABLE cellpadding="2" cellspacing="0" border="0">
     <TR><TD align="center" colspan="2"> Статистика клиента: <? echo "<b>$login ";?> </b> за: <?echo "$mon-$year"; ?> </TD></TR>
     <TR><TD colspan="2">
    
    <TABLE cellpadding="0" cellspacing="0" border="0">
     <TR><TD align="center" nowrap>
        <form action="?mod=dial_stat" method="post">
	<input type=hidden name=passwd value=dial>
        <input type=hidden name=login value=<? echo "$login";?> >
	<input type=hidden name=mon value=<? $mon=$mon-1; if ($mon==0){$mon=12; $year-=1;} echo "$mon";?> >
	<input type=hidden name=year value=<? echo "$year";?> >
        <input type="submit" name="box" value="Предыдущий месяц">
        </form>
     </TD>
				    
     <TD align="center" nowrap>
        <form action="?mod=dial_stat" method="post">
	<input type=hidden name=passwd value=dial>
        <input type=hidden name=login value=<? echo "$login";?> >
        <input type=hidden name=mon value=<? $mon=date("m"); echo "$mon";?> >
        <input type="submit" name="box" value="Текущий месяц">
        </form>
     </TD> </TR>
    </TABLE>
									    
     </TD></TR>
     <TR><TD align=center> На Вашем счету: <br> <? echo "$acct grn<br>"; ?>
     </TD><TD align=center> Платежи:<br>
    <table border=1 cellspacing=0>
    <tr><td>Дата</td><td>Сумма</td></tr>

<?    for ($i=0; $i<mysql_num_rows($que3); $i++) {
	$s=mysql_fetch_array($que3);
  echo "<tr>";
  echo "<td>$s[date]</td><td>$s[summ]</td>";
  echo "</tr>\n";
 }
?>

    <tr><td><b>Всего:</b></td><td><? echo "$payment"; ?></td></tr>

    </table>
      </TD>
     </TR>

     <TR><TD colspan="2"> Подключения: <br>

    <table border=1 cellspacing=0>
    <tr><td>Вход</td><td>Ночь</td><td>День</td><td>Номер</td><td>Счёт</td></tr>

<?    for ($i=0; $i<mysql_num_rows($que2); $i++) {
	$s=mysql_fetch_array($que2);
  echo "<tr>";
if (!$s[phone]){$num=0;} else {$num=$s[phone];}
  echo "<td>$s[intime]</td><td>$s[time_zone1]</td><td>$s[time_zone2]</td><td>$num</td><td>$s[acct]</td>";
  echo "</tr>\n";
 }
?>
    </table>

    Всего Ночь:<? echo "$day";?> часов<br>
    Всего День:<? echo "$night";?> часов<br>

    </table>
<?}else{echo "Неправильный Логин: $login";} }else {echo "Неправильная дата: $year-$mon"; }?>

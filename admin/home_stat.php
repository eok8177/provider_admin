<html>
<head> <meta http-equiv=Content-Type content="text/html; charset=koi8-r">
<title>Интернет провайдер "Lokal NET"</title>
</head>

<?php
  require("/var/www/dbm_10.1");
  if (!isset($login)) {$login="test";}
  if (!isset($mon)) {$mon=date("m");}
  if (!isset($year)) {$year=date("Y");}

  $curdate = date("d-m-Y H:i");
  $dat0=$year."-".$mon."-01 00:00:00";
  $dat1=$year."-".$mon."-31 23:59:59";
  $pdat0=$year."-".$mon."-01";
  $pdat1=$year."-".$mon."-31";

  mysql_select_db($DB1) or die("No Select DB");

if ($year>2004 AND $year<2010 AND $mon>0 AND $mon<13){
$flag="NO";
$sql0 ="SELECT name FROM users";
$que0 = mysql_query($sql0) or die ("Query error");
for ($i=0; $i<mysql_num_rows($que0); $i++) {$s=mysql_fetch_array($que0); if ($s[name]==$login){$flag="OK";}}
if ($flag==="OK"){

  $sql1 ="SELECT * FROM users WHERE name='$login'";
  $que1 = mysql_query($sql1) or die ("Query error");
  $u=mysql_fetch_array($que1);
  $user_id=$u[Id];
  $acct=round($u[acct],2);
  $abon=$u[abonplata];

  $sql1 ="SELECT * FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
  $que1 = mysql_query($sql1) or die ("Query error");

  $sql2 ="SELECT SUM(summ) FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
  $que2 = mysql_query($sql2) or die ("Query error");
    $summ=mysql_result($que2,0,0);

  $sql3 ="SELECT * FROM done_sessions WHERE user_id='$user_id' AND start_time BETWEEN '$dat0' AND '$dat1'";
  $que3 = mysql_query($sql3) or die ("Query error");

  $sql4 ="SELECT SUM(in_b),SUM(out_b) FROM done_sessions WHERE user_id='$user_id' AND start_time BETWEEN '$dat0' AND '$dat1'";
  $que4 = mysql_query($sql4) or die ("Query error");
    $in=mysql_result($que4,0,0);
    $out=mysql_result($que4,0,1);
    $in=round($in/1024/1024,2); $out=round($out/1024/1024,2);
    $inp=$in*0.15; $outp=$out*0.15;


?>

<!-------------------------------------------------------------->
    <TABLE cellpadding="2" cellspacing="0" width="100%" border="0">
    <TR><TD align="center" colspan="3"> Статистика клиента:<b> <?echo "$login"; ?> </b> за: <?echo "$mon-$year"; ?> </TD></TR>    
    <TR><TD colspan="2">

    <TABLE cellpadding="0" cellspacing="0" border="0">

    <TR><TD align="center" width="100%" nowrap>
    <form action="?mod=home_stat" method="post">
    <input type=hidden name=passwd value=test>
    <input type=hidden name=login value=<? echo "$login";?> >
    <input type=hidden name=mon value=<? $mon-=1; if ($mon==0){$mon=12; $year-=1;} echo "$mon";?> >
    <input type=hidden name=year value=<? echo "$year";?> >
    <input type="submit" name="box" value="Предыдущий месяц">
    </form>
    </TD>
				
    <TD align="center" width="100%" nowrap>
    <form action="?mod=home_stat" method="post">
    <input type=hidden name=passwd value=test>
    <input type=hidden name=login value=<? echo "$login";?> >
    <input type=hidden name=mon value=<? $mon=date("m"); echo "$mon";?> >
    <input type="submit" name="box" value="Текущий месяц">
    </form>
    </TD> </TR>

    </TABLE>
									
    </TD></TR>
    <TR>    


    <TD width=20% align=center>На Вашем счету:<br> <? echo "$acct"; ?> грн. </TD>
    <TD width=20% align=center> Абонплата:<br> <? echo "$abon"; ?> грн.     </TD>
    <TD width=60% align=center> Платежи:<br>

    <table border=1 cellspacing=0>
    <tr><td>Date</td><td>Summ</td></tr>

<?
  for ($i=0; $i<mysql_num_rows($que1); $i++) {
    $s=mysql_fetch_array($que1);
  echo "<tr><td>$s[date]</td><td>$s[summ]</td></tr>\n";
					    }
  echo "<tr><td><b>Всего :</b></td><td> $summ грн</td></tr>";?>
    </table>

    </TD></TR>
    <TR><TD align="left" colspan="3">Подключения:<br>

    <table border=1 cellspacing=0>
    <tr><td>Время входа</td><td>Длительность</td><td>Отослано</td><td>Принято</td><td>С IP адресса</td><td>MAC</td><td>счёт</td></tr>

<?
  for ($i=0; $i<mysql_num_rows($que3); $i++) {
    $s=mysql_fetch_array($que3);
	echo "<tr>";
    echo "<td><SMALL>$s[start_time]</SMALL></td><td>$s[connect_time]</td><td>$s[in_b]</td><td>$s[out_b]</td><td><SMALL>$s[from_IP]</SMALL></td><td><SMALL>$s[arp]</SMALL></td><td><SMALL>$s[acct]</SMALL></td>";
	echo "</tr>\n";
					    }
?>

    </table>
    
<? echo "<br>In : $in Mb Получено от пользователя ($inp grn)<br>Out: $out Mb Отослано пользователю ($outp grn)<br>";?>

    </TD> </TR>
    </TABLE>

<?} else {echo"Неправильный Логин: $login";} }else {echo "Неправильная дата: $year-$mon";}?>


<TABLE cellpadding="0" cellspacing="0" border="0">
 <TR>				    
 <TD align="center" nowrap>
    <form action="?mod=all_dial" method="post">

<td align="right"><font color="#0000ff" size=2 face="times">mon:</font></td>
   <td align="left"><input type="text" name="mon" size="9" value=""></td>
<td align="right"><font color="#0000ff" size=2 face="times">year:</font></td>
   <td align="left"><input type="text" name="year" size="9" value=""></td>

<td>    <input type="submit" name="box" value="Просмотр"> </td>
    </form>
 </TD> </TR>
</TABLE>




<TABLE cellpadding="2" cellspacing="0" border="1">
 <TR><td>Логин</td><td>Ночь</td><td>День</td><td>in_b</td><td>out_b</td><td>Платежи</td><td>Счет</td></TR>





<?
  if (!isset($login)) {$login="souzpp";}
  if (!isset($mon)) {$mon=date("m");}
  if (!isset($year)) {$year=date("Y");}

 if ($mon==date("m")) {$cday=date("d");} else{$cday=30;}

  $curdate = date("d-m-Y H:i");
  $dat0=$year."-".$mon."-01 00:00:00";
  $dat1=$year."-".$mon."-31 23:59:59";
  $pdat0=$year."-".$mon."-01";
  $pdat1=$year."-".$mon."-31";

  require("/var/www/dbm_0.1");
  mysql_select_db($DB1) or die("No Select DB");

  $sql0 ="SELECT login FROM users";
   $que0 = mysql_query($sql0) or die ("Query error");


    for ($i=0; $i<mysql_num_rows($que0); $i++) {
	$s=mysql_fetch_array($que0); $login=$s[login];
  echo "<tr>";
  echo "<td>$login</td>";

  require("/var/www/dbm_0.1");
  mysql_select_db($DB1) or die("No Select DB");


  $sql2 ="SELECT id, acct, gr FROM users WHERE login='$login'";
   $que2 = mysql_query($sql2) or die ("Query error");
   $user_id=mysql_result($que2,0,0);
   $acct=mysql_result($que2,0,1);
   $gr=mysql_result($que2,0,2);
 if($acct > 0){$s_acct+=$acct;}

  mysql_select_db($DB2) or die("No Select DB");

  $sql4="SELECT SUM(summ) FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
   $que4 = mysql_query($sql4) or die ("Query error");
   $payment=mysql_result($que4,0,0);
   $s_payment+=$payment;

  require("/var/www/dbm_0.10");
  mysql_select_db($DB1) or die("No Select DB");

  $sql5="SELECT SUM(hour(time_zone1))+SUM(minute(time_zone1))/60+SUM(second(time_zone1))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que5 = mysql_query($sql5) or die ("Query error");
   $night=mysql_result($que5,0,0);
   if ($gr==1){$s_night+=$night;}

  $sql6="SELECT SUM(hour(time_zone2))+SUM(minute(time_zone2))/60+SUM(second(time_zone2))/60/60 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que6 = mysql_query($sql6) or die ("Query error");
   $day=mysql_result($que6,0,0);
   if ($gr==1){$s_day+=$day;}

  $sql7="SELECT SUM(in_b)/1024/1024 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que7 = mysql_query($sql7) or die ("Query error");
   $in_b=mysql_result($que7,0,0);
   if ($gr==1){$s_in_b+=$in_b;}

  $sql8="SELECT SUM(out_b)/1024/1024 FROM prim WHERE intime BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que8 = mysql_query($sql8) or die ("Query error");
   $out_b=mysql_result($que8,0,0);
   if ($gr==1){$s_out_b+=$out_b;}

  echo "<td>$night</td><td>$day</td><td>$in_b</td><td>$out_b</td><td>$payment</td><td>$acct</td>";
  echo "</tr>\n";
 }

  echo "<TR><td>&nbsp</td><td>Ночь</td><td>День</td><td>in_b</td><td>out_b</td><td>Платежи</td><td>Счет</td></TR>";
  echo "<tr><td>Всего:</td><td>$s_night</td><td>$s_day</td><td>$s_in_b</td><td>$s_out_b</td><td>$s_payment</td><td>$s_acct</td>";
  echo "</tr>\n";
  echo "</table>";

$zagr=($s_night+$s_day)/6/($cday*24)*100; $zagr=round($zagr,0);
echo "Средняя загрузка за месяц: $zagr %";


?>







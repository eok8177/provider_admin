<TABLE cellpadding="0" cellspacing="0" border="0">
 <TR>				    
 <TD align="center" nowrap>
    <form action="?mod=all_home" method="post">
    <input type=hidden name=login value=
    <? echo "$login";?>
    >

<td align="right"><font color="#0000ff" size=2 face="times">mon:</font></td>
   <td align="left"><input type="text" name="mon" size="9" value=""></td>
<td align="right"><font color="#0000ff" size=2 face="times">year:</font></td>
   <td align="left"><input type="text" name="year" size="9" value=""></td>

<td>    <input type="submit" name="box" value="Просмотр"> </td>
    </form>
 </TD> </TR>
</TABLE>



<TABLE cellpadding="2" cellspacing="0" border="1">
<TR><td>Логин</td><td>Время</td><td>Отправил</td><td>Принял</td><td>Платежи</td><td>Счет</td></TR>



<?
if (!isset($mon)) {$mon=date("m");}
if (!isset($year)) {$year=date("Y");}

  $curdate = date("d-m-Y H:i");
  $dat0=$year."-".$mon."-01 00:00:00";
  $dat1=$year."-".$mon."-31 23:59:59";
  $pdat0=$year."-".$mon."-01";
  $pdat1=$year."-".$mon."-31";

  require("/var/www/dbm_10.1");
  mysql_select_db($DB1) or die("No Select DB");

  $sql0 ="SELECT name FROM users";
   $que0 = mysql_query($sql0) or die ("Query error");


    for ($i=0; $i<mysql_num_rows($que0); $i++) {
	$s=mysql_fetch_array($que0); $login=$s[name];
  echo "<tr>";
  echo "<td>$login</td>";


  $sql2 ="SELECT id, acct, groupe FROM users WHERE name='$login'";
   $que2 = mysql_query($sql2) or die ("Query error");
   $user_id=mysql_result($que2,0,0);
   $acct=mysql_result($que2,0,1);
   $gr=mysql_result($que2,0,2);
 if($acct > 0){$s_acct+=$acct;}

  $sql4="SELECT SUM(summ) FROM payment WHERE user_id='$user_id' AND date BETWEEN '$pdat0' AND '$pdat1'";
   $que4 = mysql_query($sql4) or die ("Query error");
   $payment=mysql_result($que4,0,0);
   $s_payment+=$payment;

  $sql5="SELECT SUM(hour(connect_time))+SUM(minute(connect_time))/60+SUM(second(connect_time))/60/60 FROM done_sessions WHERE start_time BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que5 = mysql_query($sql5) or die ("Query error");
   $night=mysql_result($que5,0,0);
   if ($gr==1){$s_night+=$night;}
#echo "<td>$user_id $acct $gr $payment $night</td>";}
  $sql7="SELECT SUM(in_b)/1024/1024 FROM done_sessions WHERE start_time BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que7 = mysql_query($sql7) or die ("Query error");
   $in_b=mysql_result($que7,0,0);
   if ($gr==1){$s_in_b+=$in_b;}

  $sql8="SELECT SUM(out_b)/1024/1024 FROM done_sessions WHERE start_time BETWEEN '$dat0' AND '$dat1' AND user_id='$user_id'";
   $que8 = mysql_query($sql8) or die ("Query error");
   $out_b=mysql_result($que8,0,0);
   if ($gr==1){$s_out_b+=$out_b;}

  echo "<td>$night</td><td>$in_b</td><td>$out_b</td><td>$payment</td><td>$acct</td>";
  echo "</tr>\n";
 }


  echo "<tr><td>Всего:</td><td>$s_night</td><td>$s_in_b</td><td>$s_out_b</td><td>$s_payment</td><td>$s_acct</td>";
  echo "</tr>\n";

?>
</table>



</table>

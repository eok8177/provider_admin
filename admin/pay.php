<?
if (!isset($year)) {$year=date("Y");}
if (!isset($mon))  {$mon=date("m");}
if (!isset($day))  {$day=date("d");}
  

require("/var/www/dbm_0.1");

#$curdate = date("d-m-Y H:i");
$pdat=$year."-".$mon."-".$day;

mysql_select_db($DB2) or die("No Select DB");

$sql3="SELECT * FROM payment WHERE date='$pdat'";
$que3 = mysql_query($sql3) or die ("Query error");

$sql4="SELECT SUM(summ) FROM payment WHERE date='$pdat'";
$que4 = mysql_query($sql4) or die ("Query error");
$payment=mysql_result($que4,0,0);

?>


<!------------------------------------------------------------------------------->

<TABLE cellpadding="2" cellspacing="0" border="0">

 <TR><TD colspan="2">
    
<TABLE cellpadding="0" cellspacing="0" border="0">
 <TR><TD align="center" nowrap>
    <form action="?mod=pay" method="post">
    <input type=hidden name=day value= <? $day=$day-1; if ($day==0){$day=31; $mon-=1;} echo "$day";?> >
    <input type=hidden name=mon value=<? echo "$mon";?> >
    <input type="submit" name="box" value="Предыдущий день">
    </form>
 </TD>
				    
 <TD align="center" nowrap>
    <form action="?mod=pay" method="post">
    <input type=hidden name=day value= <? $day=date("d"); echo "$day";?> >
    <input type="submit" name="box" value="Текущий день">
    </form>
 </TD> </TR>
</TABLE>
									    
 </TD></TR>

 <TR><TD align=center> Платежи: <br> за <? echo "$pdat";?> <br>

<table border=1 cellspacing=0>
<tr><td>Логин</td><td>Сумма</td></tr>

<?    for ($i=0; $i<mysql_num_rows($que3); $i++) {
	$s=mysql_fetch_array($que3);

mysql_select_db($DB1) or die("No Select DB");
$sql1 ="SELECT login FROM users WHERE id='$s[user_id]'";
$que1 = mysql_query($sql1) or die ("Query error");
$login=mysql_result($que1,0,0);


  echo "<tr>";
  echo "<td>$login</td><td>$s[summ]</td>";
  echo "</tr>\n";
 }
?>

<tr><td><b>Всего:</b></td><td><? echo "$payment"; ?></td></tr>

</table>


  </TD>
 </TR>


</table>

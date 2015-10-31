<?php
    if (!isset($mon)) {$mon=date("m");}
    if (!isset($year)) {$year=date("Y");}

require("/var/www/dbm_0.10");


$dat0=$year."-".$mon."-01 00:00:00";
$dat1=$year."-".$mon."-31 23:59:59";

mysql_select_db($DB2) or die("No Select DB");

#$names[0]="lan"; $names[1]="211"; $names[2]="212"; $names[3]="213"; $names[4]="214"; $names[5]="215"; $names[6]="216"; $names[7]="217"; $names[8]="218"; $names[9]="219";
#$names[10]="220"; $names[11]="221"; $names[12]="222"; $names[13]="223"; $names[14]="224"; $names[15]="225"; $names[16]="226"; $names[17]="227"; $names[18]="228"; $names[19]="229";
#$names[20]="230"; $names[21]="home"; $names[22]="server"; $names[23]="locker"; $names[24]="ppp01"; $names[25]="ppp02"; $names[26]="ppp11"; $names[27]="ppp12"; $names[28]="ppp13"; $names[29]="ppp14";

 $names[15]="225";
?>

<TABLE cellpadding="0" cellspacing="0" border="0">
<TR><TD align="center" nowrap>
 <form action="?mod=lan" method="post">
    <input type=hidden name=mon value=<? $month=$mon-1; if ($month==0){$month=12; $year-=1;} echo "$month";?> >
    <input type=hidden name=year value=<? echo "$year";?> >
 <input type="submit" name="box" value="Предыдущий месяц">
 </form>
</TD>

<TD align="center" nowrap>
 <form action="?mod=lan" method="post">
    <input type=hidden name=mon value=<? $month=date("m"); echo "$month";?> >
 <input type="submit" name="box" value="Текущий месяц">
 </form>
</TD> </TR>
</TABLE>

<?php

echo "Статистика за: $mon - $year <br> <br>";
echo "<table border=1 >";
echo "<tr><td>Имя</td><td>Отослано МБ</td><td>Принято МБ</td></tr>";

foreach ($names as $key=>$ip){


$sql1 ="SELECT SUM(inb),SUM(outb) FROM traffic WHERE ip='$ip' AND datetime BETWEEN '$dat0' AND '$dat1'";
$que1 = mysql_query($sql1) or die ("Query error");
$s1=mysql_fetch_array($que1);
$in_sum=round(($s1[0]/1024/1024),2); $out_sum=round(($s1[1]/1024/1024),2);



echo "<tr><td>$ip</td><td>$in_sum</td><td>$out_sum</td></tr>";

}

?>

</table>
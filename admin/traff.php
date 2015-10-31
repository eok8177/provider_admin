<form action="?mod=traff" method="POST">

<select name="year" size=1> 
 <option value=2005>2005</option>
 <option value=2006>2006</option> 
 <option value=2007 selected>2007</option>
 <option value=2008>2008</option>  
</select>

<select name="mon" size=1>
  <?
   $m=date(m);
   for ($i=01; $i<=12; $i++){
    $n=$i;
    $len=strlen($i);
    if ($len==1){$n="0".$i;}
    echo "  <option value=$n";
    if ($n==$m){echo " selected";}
    echo " >$n</option>\n";
    }
  ?>
</select>

<select name="day" size=1>
  <?
   $d=date(d);
   for ($i=01; $i<=31; $i++){
    $n=$i;
    $len=strlen($i);
    if ($len==1){$n="0".$i;}
    echo "  <option value=$n";
    if ($n==$d){echo " selected";}
    echo " >$n</option>\n";
    }
  ?>
</select>

<input type="submit" name="go" value="View">
</form>


<?
  if (!isset($mon)) {$mon=date("m");}
  if (!isset($day)) {$day=date("d");}
  if (!isset($year)) {$year=date("Y");}
?>

<?
#echo "year=$year&mon=$mon&day=$day&ip=pentanet\"<br><br>\n";

echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=lan\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=home\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=server\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=locker\"><br><br>\n";

echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=211\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=212\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=213\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=214\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=215\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=216\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=217\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=218\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=219\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=220\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=221\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=222\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=223\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=224\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=225\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=226\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=227\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=228\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=229\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=230\"><br><br>\n";



echo "<br><br>";

echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp01\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp02\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp11\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp12\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp13\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp14\"><br><br>\n";
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=yura\"><br><br>\n";

#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=dial\"><br><br>\n";
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=legion\"><br><br>\n";

?>

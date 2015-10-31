<form action="?mod=dial" method="POST">

<select name="year" size=1> 
 <option value=2005>2005</option>
 <option value=2006>2006</option>
 <option value=2007>2007</option> 
 <option value=2008 selected>2008</option> 
 <option value=2009>2009</option> 
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
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=pentanet\"><br><br>\n";

echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=lan\"><br><br>\n";

echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp01\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp02\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp11\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp12\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp13\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=ppp14\"><br><br>\n";
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=yura\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=home\"><br><br>\n";
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=dial\"><br><br>\n";
#echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=legion\"><br><br>\n";

?>

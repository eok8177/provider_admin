<form action="?mod=game" method="POST">

<select name="year" size=1> 
 <option value=2005>2005</option>
 <option value=2006 selected>2006</option>
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
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=pentanet\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=server\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-1\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-2\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-3\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-4\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-5\"><br><br>\n";
echo "<img src=\"graph.php?year=$year&mon=$mon&day=$day&ip=k-6\"><br><br>\n";

?>

<?php
Header("Content-type: image/png");

require("/var/www/dbm_0.10");

$dat0=$year."-".$mon."-".$day." 00:00:00";
$dat1=$year."-".$mon."-".$day." 23:59:59";

mysql_select_db($DB2) or die("No Select DB");

$sql1 ="SELECT datetime,inb,outb FROM traffic WHERE ip='$ip' AND datetime BETWEEN '$dat0' AND '$dat1' ORDER BY datetime";
    $que1 = mysql_query($sql1) or die ("Query error");

$sql2 ="SELECT MAX(inb),MAX(outb) FROM traffic WHERE ip='$ip' AND datetime BETWEEN '$dat0' AND '$dat1' ORDER BY datetime";
    $que2 = mysql_query($sql2) or die ("Query error");
    $s2=mysql_fetch_array($que2);
    $in_max=$s2[0]*8/240/1024; $out_max=$s2[1]*8/240/1024;
    if ($out_max>$in_max){$max=$out_max;}else {$max=$in_max;}
     $m=round($max,0);

$sql3 ="SELECT SUM(inb),SUM(outb) FROM traffic WHERE ip='$ip' AND datetime BETWEEN '$dat0' AND '$dat1' ORDER BY datetime";
    $que3 = mysql_query($sql3) or die ("Query error");
    $s3=mysql_fetch_array($que3);
    $in_sum=round(($s3[0]/1024/1024),2); $out_sum=round(($s3[1]/1024/1024),2);


$im=ImageCreate(500,180); #Создание рисунка

##### Определение цветов
    $white=imagecolorallocate($im,255,255,255);
    $red=imagecolorallocate($im,255,0,0);
    $green=imagecolorallocate($im,0,170,0);
    $blue=imagecolorallocate($im,0,0,255);
    $black=imagecolorallocate($im,0,0,0);
    $grey=imagecolorallocate($im,192,192,192);


for ($i=0; $i<=24; $i++){#Сетка - вертикальные линии
    ImageDashedLine($im,80+($i*15),20,80+($i*15),120,$grey);
    ImageLine($im,80+($i*15),118,80+($i*15),122,$black);
    ImageString($im,1,78+($i*15),123,$i,$black);
			}

for ($i=1; $i<=4; $i++){#Сетка - горизонтальные линии
    ImageDashedLine($im,80,20+($i*20),440,20+($i*20),$grey);
    ImageLine($im,78,20+($i*20),82,20+($i*20),$black);
			}
###### Вывод надписей ######
    $m100=round($max,0)." kb/s";
    $m80=round(($max*0.55),0)." kb/s";
    $m60=round(($max*0.2),0)." kb/s";
    $m40=round(($max*0.074),0)." kb/s";
    $m20=round(($max*0.027),0)." kb/s";

    ImageString($im,1,40,15,$m100,$black);
    ImageString($im,1,40,35,$m80,$black);  
    ImageString($im,1,40,55,$m60,$black);    
    ImageString($im,1,40,75,$m40,$black);  
    ImageString($im,1,40,95,$m20,$black);    

    ImageRectangle($im,80,20,440,120,$black);

    ImageString($im,2,220,5,$ip,$black);
    ImageString($im,2,455,80,($day."-".$mon),$black);
    ImageString($im,2,460,100,$year,$black);

    $in_max=round($in_max,2); $out_max=round($out_max,2);

    $str="Max_in=$in_max kb/s     Sum_in=$in_sum MB ";
    ImageString($im,2,100,140,$str,$blue);

    $str="Max_out=$out_max kb/s   Sum_out=$out_sum MB";
    ImageString($im,2,100,155,$str,$green);

    $x=80; $old_in=0;
for ($i=0; $i<=(mysql_num_rows($que1)-1); $i++) { #Построение графика с массива
    $s=mysql_fetch_array($que1);
    $t=(substr($s[datetime],11,2)*60+substr($s[datetime],14,2))/4;

    $inb=($s[inb]*8/240/1024)*100/$max;
    $outb=($s[outb]*8/240/1024)*100/$max;
    if ($inb>1) $inb=20*log($inb);
    if ($outb>1) $outb=20*log($outb);
     ImageLine($im,$x+$t,120,$x+$t,120-$outb,$green);
     ImageLine($im,$x+$t,120-$old_in,$x+$t,120-$inb,$blue);
    $old_in=$inb;
						}

ImagePng($im); #Вывод рисунка
ImageDestroy($im); #Очистка памяти

?>
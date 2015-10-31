
<html>
<head> <meta http-equiv=Content-Type content="text/html; charset=koi8-r">
<title>Интернет провайдер "Lokal NET"</title>
</head>

<body bgcolor="#00349A" text="#000000" link="#00349A" alink="#00349A" vlink="#00349A" background="/fon.jpg" >

<table bgcolor="#F0EDFE" width=800 align=center cellpadding=0 cellspacing=0 border=0>

<tr><td colspan="3" align=left valign=bottom bgcolor="#D3E5FD"><img src="/header.jpg" height=54 width=800></td></tr>

<tr> <td valign=top align=center width=131 bgcolor=#D3E5FD>

<? if ($REMOTE_ADDR=="192.168.2.254" OR $REMOTE_ADDR=="192.168.10.20" OR $REMOTE_ADDR=="192.168.10.50" OR $REMOTE_ADDR=="192.168.10.60") {?>
    <a href="/adm/" class="leftmenu">Admin</a><br>
    
    <?}
    echo "$REMOTE_ADDR";
    ?>
    
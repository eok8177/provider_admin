<?
 if (isset($upload))
  {
  
   copy($UFile, "/var/www/adm/".basename($UFile_name));
   echo "<PRE> ���� ���������� </PRE>";
  } else
  {?>
<html><head><title>File</title></head><body>
<form action=files.php method=POST enctype=multipart/form-data>
<input type=file name=UFile>
��� ����� �� ������� <input type=text name=UFile_name>
<input type=submit name=upload value=���������>
</form>
</body></html>
<?}?>
 
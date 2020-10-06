<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Backup</title>
</head>

<body background="bg.jpg" style="margin:0px;" >

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?> 
</td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<br />
<br />
<form  action="csvExport.php"  method="post">
<table width="40%" border="1" cellspacing="2" cellpadding="2" align="center" bgcolor="#FFFFFF">
  <tr bgcolor="#000000">
    <td align="center"><font size="+1" face="Courier New, Courier, monospace" color="#FFFFFF"><b>Take the data backup as on <font color="#FF0000"><?php 
	date_default_timezone_set("Asia/Kolkata");
	$dateTime=date('D d-M-Y ');
	echo $dateTime;
	?> </font></b></font></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
    <select name="tableName" required>
    <option label="Select the field to proceed" value="-1" disabled selected>&nbsp;Select the field to proceed&nbsp;</option><option disabled>-------</option>
<option disabled>&nbsp;&nbsp;</option>
<option value="payment">Backup Payment history</option>
<option disabled>&nbsp;&nbsp;</option>
<option value="purchase">Backup Purchase history</option>
<option disabled>&nbsp;&nbsp;</option>
<option value="sold">Backup Sold history</option>
<option disabled>&nbsp;&nbsp;</option>
<option value="serialno">Backup Serial No. history</option>
    </select> 
    <input type="submit" value="CSV export" /></td>
  </tr>
</table>
</form>

</body>
</html>
<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Credit Customer Type</title>
</head>
<body style="margin:0px auto;" >
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>

<table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="center" bgcolor="#000000"><h3><font color="#FFFFFF">Choose Credit Customer Type</font></h3></td></tr>
<tr><td  align="center">&nbsp;</td></tr>
<tr>
<td  align="center">
<form name="f1" method="post" action="creditCustomer.php?existing=1"><input type="Submit" style="width: 300px; height:50px;" name="purchase" value="Existing Credit Customer"/></form>
</td>
</tr>
<tr><td  align="center">&nbsp;</td></tr>
<tr>
<td  align="center"><form name="f2" method="post" action="addCreditCustomer.php"><input type="Submit" style="width: 300px; height:50px;" name="dealer" value="New Credit Customer"/></form>
</td>
</tr>
</table>
</body>
</html>
<?php 
}else{
	header('location:index.php');
}
 ?>
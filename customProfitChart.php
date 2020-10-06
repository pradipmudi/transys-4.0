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
<title>Customize Profit Chart</title>
</head>
<body style="margin:0px auto;" >
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>

<table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="center" bgcolor="#000000"><h3><font color="#FFFFFF">Choose to Generate Profit Chart</font></h3></td></tr>
<tr><td  align="center">&nbsp;</td></tr>
<tr>
<td  align="center">
<form name="f1" method="post" action="generateProfitChart.php?type=week"><input type="Submit" style="width: 300px; height:50px;" name="purchase" value="Profit Chart of the Week"/></form>
</td>
</tr>
<tr><td  align="center">&nbsp;</td></tr>
<tr>
<td  align="center"><form name="f2" method="post" action="generateProfitChart.php?type=month"><input type="Submit" style="width: 300px; height:50px;" name="dealer" value="Profit Chart of the Month"/></form>
</td>
</tr>
<tr><td  align="center">&nbsp;</td></tr>
<tr>
<td  align="center"><form name="f3" method="post" action="generateProfitChart.php?type=year"><input type="Submit" style="width: 300px; height:50px;" name="dealer" value="Profit Chart of the Year"/></form>
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

<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
?>	  
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Search</title>
<style type="text/css">
#display_results {color: red; background: #CCCCFF; }
#main {padding: 2px; margin: 100px; margin-left: 200px; width:1000px; color: #FFF;  background-color:#000 width: 520px; }
</style>
</head>

<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br>
<br>

<table bgcolor="#FFFFFF" id="main" width="40%">
  <tr bgcolor="#000000">
    <td align="center" colspan="2"><h3> Search  by Invoice No. or Serial No. or Date(format : yyyy-mm-dd): </h3>
      <br>
      <font color="#00FF00">
        <?php
error_reporting(0); 
$success=$_GET['success'];
$invalid_file=$_GET['invalid_file'];
if($success==1)
	{
	echo "The details of new customer has been successfully saved!";
	}
?>
      </font></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><form id="searchform" method="post" action="showInvoiceResults.php">
      <label><font color="#000000">Search : </font></label>
      <input type="text" name="search_query" id="search_query" placeholder="Type a Category name" size="50" required/>
      <input type="submit" value="GO" id="button_find" />
    </form></td>
  </tr>
  <tr>
    <td align="center"  id="display_results" colspan="2"></td>
  </tr>
</table>
</body>
</html>
<?php 
}
else
{
	header('location:index.php');
}
 ?>
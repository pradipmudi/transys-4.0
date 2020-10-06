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
<title>Add User</title>
</head>

<body style="margin:0px auto;" >

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>
<br>

<table width="40%" border="0" cellspacing="5" cellpadding="0" align="center" bgcolor="#CCCCCC">
  <tr>
    <th colspan="2" scope="col"><h2>Add User</h2></th>
  </tr>
  <tr>
    <th scope="row" align="left">User Type :</th>
    <td>
    <select name="userType">
    <option selected disabled>Select</option>
    <option disabled>-------------</option>
    <option value="Super">Super</option>
    <option value="normal">Normal/Executive</option>
    </select>
    </td>
  </tr>
  <tr>
    <th scope="row" align="left">Username :</th>
    <td><input type="text" name="username" placeholder="Choose Username"></td>
  </tr>
  <tr>
    <th scope="row" align="left">Password :</th>
    <td><input type="password" name="password" placeholder="Choose Password"></td>
  </tr>  
  <tr>
    <th colspan="2" scope="row"><input type="submit" name="saveUser" value="Save User"></th>
  </tr>
</table>



</body>
</html>
<?php 
}else{
	header('location:index.php');
}
 ?>
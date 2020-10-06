<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
?>

<?php  error_reporting(0);   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
<title>Bulk Purchase Upload</title>
</head>

<body style="margin:0px;" >

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr><td width="100%">
				 <?php include("header.php"); ?> 
				</td></tr>
				</table>
				<br/>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////-->

 <form action="csvPurchaseRecordUpload.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return(csv_or_not());">

<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr><td align="center" width="100%">
				<font color="#FF3333">
            <?php 
			$invalid=$_GET[invalid_file];
			$valid=$_GET[success];
			//echo $valid;
			//echo $invalid;
			if($valid==1)
			{ echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice 
			else if($invalid==1)
			{ echo "<b>Wrong File Choosen ! Please upload only CSV Files.</b><br><br>"; } //generic success notice ?>
				</font>
				</td></tr>
				<tr bgcolor="#000000"><td align="center" width="100%"><font color="#FFFFFF" size="+2"><b>Choose  CSV file to upload :</b></font></td></tr>
				<tr><td align="center" width="100%">&nbsp;</td></tr>
				<tr><td align="center" width="100%"> 
              <input name="csv" type="file" id="csv" />
			  </td></tr>
			  <tr><td align="center" width="100%">&nbsp;</td></tr>
			  <tr><td align="center" width="100%">
              <input type="submit" style="width: 250px; height:40px;" name="Submit" value="Import Purchase Details Data by CSV" /></td></tr>
			</table>
            </form> <br />  <br />
<table width="75%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><font color="#008000"><h2>CSV upload format DEMO for uploading purchase records</h2></font>
  <br />
  </td>
  </tr>
<tr>
    <td align="center">
<img src="purchaseCsvDemo/purchaseCsvDemo.png"/></td>
  </tr>
</table>

<br />
<br />

		
   

</body>
</html>

<?php 
}else{
	header('location:index.php');
}
 ?>
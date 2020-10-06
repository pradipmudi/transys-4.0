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
<title>Dealer Details</title>
</head>
<script language="javascript">
      <!--
      function isNumberKey(evt)
      {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
      }
</script>
<body background="bg.jpg" style="margin:0px;">

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?> 
</td></tr>
</table>
<br/><br/><br/>
<?php
		$id=$_GET['id'];
		
		$output=mysqli_query($dbhandle,"Select * From dealer where id='$id'");	
		
	while($opt = mysqli_fetch_array($output))
  {
	 $dealerBalanceDue=$opt['balance'];
	 $dealerName=$opt['name'];
?>

<table width="60%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#000000">
    <td align="center" colspan="2"><b>
    <h1><font color="#FFFFFF"><?php echo $opt['name'];?></font></h1></b></td>
  </tr>
  
  <tr>
    <td align="left" colspan="1" width="50%"><u><font color="#0000FF"><h3><b>Account Information</b><br>
    </h3>
    </font></u>
      <p><b>&nbsp;Bank Name&nbsp;:&nbsp;&nbsp;</b><?php echo $opt['bankName'];?></p>
      <p><b>&nbsp;A/C No.&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $opt['account'];?></p>
      </td>
    <td align="left" colspan="1" width="50%"><u><font color="#0000FF"><h3><b>Address</b><br></h3></font></u>
      &nbsp;<?php echo $opt['address'];?> 
    
      <p><b>&nbsp;Contact :&nbsp;&nbsp;</b><?php echo $opt['phone'];?></p>
      </td>
  </tr>

  <tr></tr>
  <tr><td colspan="2">&nbsp;</tr>
  <tr>
    <td align="left" colspan="2"><?php 
	$query=mysqli_query($dbhandle,"Select * From purchase where dealer='$id' order by entryDate desc limit 5");
	$no=mysqli_num_rows($query);
	echo "<table border='1'  align=\"center\"width=\"100%\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">
";
if($no>0)
{
echo "<tr bgcolor=\"#CCCCCC\"><td align=\"center\" colspan=\"10\"><b><font size=\"+1\" face=\"Courier New, Courier, monospace\">Last ".$no." Transactions with ".$id."</font></b></td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#000000\">
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Product Name</font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Category </font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Sub-category</font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Date of Purchase</font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Price</font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Quantity </font></th>
<th width=\"14.28%\" align=\"center\"><font color=\"#FFFFFF\">Total Amount </font></th>



</tr>";

while($op = mysqli_fetch_array($query))
  {
	  $val=explode("//",$op['categorySubCategory']);
$category=strtoupper($val[0]);
$subCategory=strtoupper($val[1]);
  echo "<tr>";
  echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . $op['name'] . "</td>";
  echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . $category . "</td>";
  echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . $subCategory . "</td>";
  echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . $op['purchaseDate'] . "</td>";
  echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . number_format((float)$op['price'], 2, '.', '') . "</td>";
   echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . $op['quantity'] . "</td>";
    $totalPrice=$op['price']*$op['quantity'];
    echo "<td width=\"14.28%\" align=\"center\" size=\"+1\">" . number_format((float)$totalPrice, 2, '.', '') . "</td>";
  echo "</tr>";

  }
  }
  if($no<1)
  {
echo "<tr><td colspan=\"7\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
  }
 
echo "<tr><td colspan=\"4\" align=\"center\" size=\"+1\"><b><a href=\"paymentHistory.php?id=".$_SESSION['user']."&dealer=$id\">Click here to see the Payment History</a></td><td colspan=\"3\" align=\"center\" size=\"+1\"><b><font color=\"#FF0000\">Balance Due :</font>&nbsp;".$dealerBalanceDue."</b></td></tr>"; 
echo "</table>";




   
?></td>
  </tr>
</table>
<form enctype="multipart/form-data" action="savePayment.php?id=<?php echo $id?>" method="post">
<table width="60%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td width="25%" align="left"><b>Billing Amount :</b></td>
  <td width="25%" align="left"><input type="text" placeholder="Enter the billing amount" id="billingAmount" name="billingAmount" onkeypress="return isNumberKey(event)"   required/>
  <input type="hidden" name="balanceDue" value="<?php echo $dealerBalanceDue;?>"/>
  <input type="hidden" name="dealerName" value="<?php echo $dealerName;?>"/></td><td width="25%" align="left"><b>Cash receipt : </b></td><td width="25%" align="left"><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
    <input name="file" type='file' onchange="readURL(this);" /></td></tr>
    <tr><td colspan="4" align="right" width="40%"><font color="#FF0000">
<?php 
$invalid_file=$_GET['invalid_file'];
if($invalid_file==1)
	{
	echo "Invaid File!Please upload as image only.";
	}

?>
</font>&nbsp;</td></tr>
<tr>
  <td colspan="4" align="center" width="40%"><input type="submit" name="save" value="Save"  /></td></tr>
</table>
</form>


<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->
</body>
</html>

<?php
  }
  mysql_close($dbhandle);
}else{
	header('location:index.php');
}
 ?>
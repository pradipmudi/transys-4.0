<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>TranSys</title>

<script>
function gninvoice() {
    var x;
    if (confirm("Do you Want to Save Invoice Data..?") == true) {
        x = "saved";
    } else {
        x = "tmp";
    }
    alert(x);
}
</script>




</head>
<body style="margin:0px auto;" >

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>


<?php


$output=mysqli_query($dbhandle,"Select name From admin where username='".$_SESSION['user']."'");

$no=mysqli_num_rows($output);

$fetch=mysqli_fetch_array($output);
$firstName=explode(" ", $fetch['name']);
?>




<table width="50%" border="0" align="center" cellpadding="0" cellspacing="8">

<tr><td colspan="4" align="center"><h3>Welcome  <b><font color="green"><?php echo $firstName[0]; ?></font></b>&nbsp;</h3></td></tr>

<tr>
<td colspan="1" align="center">
<form name="f1" method="post" action="purchasedProductInfo.php"><input type="Submit" style="width: 250px; height:50px;" name="purchase" value="Add Purchase Deatils"/></form>
</td>
<td colspan="1" align="center"><form name="f2" method="post" action="addDealer.php"><input type="Submit" style="width: 250px; height:50px;" name="dealer" value="Add New Dealer"/></form>
</td>
<td colspan="1" align="center">
<form name="f3" method="post" action="purchaseDetails.php"><input type="Submit" style="width: 250px; height:50px;" name="purchaseRecords" value="Purchase Records"/></form>
</td>

<td colspan="1" align="center">
<form name="f4" method="post" action="saveCategory.php"><input type="Submit" style="width: 250px; height:50px;" name="cat" value="Add new Product category"/></form>
</td>
</tr>


<tr>
<td colspan="1" align="center">
<form name="f5" method="post" action="searchDealer.php"><input type="Submit" style="width: 250px; height:50px;" name="searchDealer" value="Search Dealer here"/></form>
</td>

<td colspan="1" align="center">
<form name="f6" method="post" action="dataBackup.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Take Data backup Here"/></form>
</td>

<td colspan="1" align="center">
<form name="f7" method="post" action="productStock.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="See Product Stock here"/></form>
</td>

<td colspan="1" align="center">
<form name="f8" method="post" action="invoiceGenerate.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Search Invoice Here"/></form>
</td>
</tr>

<tr>
<td colspan="1" align="center">
<form name="f9" method="post" action="creditCustomer.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Search Credit Customer here"/></form>
</td>

<td colspan="1" align="center">
<form name="f10" method="post" action="customerType.php"><input type="Submit" style="width: 250px; height:50px;" name="" value=" Sales "/></form>
</td>
<td colspan="1" align="center">
<form name="f11" method="post" action="customProfitChart.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Profit Chart Here"/></form>
</td>

<td colspan="1" align="center">
<form name="f12" method="post" action="bulkPurchaseUpload.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Purchase Data Bulk Upload"/></form>
</td>
</tr>

<tr>
<td colspan="1" align="center">
<form name="f13" method="post" action="customerNextInstallment.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Customer Next Installment Date List"/></form>
</td>

<td colspan="1" align="center">
<form name="f14" method="post" action="#"><input type="Submit" style="width: 250px; height:50px;" name="" value="###"/></form>
</td>
<td colspan="1" align="center">
<form name="f15" method="post" action="productSold.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Sold Product List"/></form>
</td>

<td colspan="1" align="center">
<form name="f16" method="post" action="quick_sale.php"><input type="Submit" style="width: 250px; height:50px;" name="" value="Quick sale"/></form>
</td>
</tr>

<tr>
<td colspan="1" align="center">
<form name="f17" method="post" action="#"><input type="Submit" style="width: 250px; height:50px;" name=""  onclick = "gninvoice()" value="Generate Invoice"/></form>
</td>

<td colspan="1" align="center">
<form name="f18" method="post" action="#"><input type="Submit" style="width: 250px; height:50px;" name="" value="###"/></form>
</td>
<td colspan="1" align="center">
<form name="f19" method="post" action="#"><input type="Submit" style="width: 250px; height:50px;" name="" value="###"/></form>
</td>

<td colspan="1" align="center">
<form name="f20" method="post" action="#"><input type="Submit" style="width: 250px; height:50px;" name="" value="###"/></form>
</td>
</tr>


</table>




<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add footer here !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->


   
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add footer here !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
   

</body>
</html>
<?php 
}else{
	header('location:index.php');
}
 ?>
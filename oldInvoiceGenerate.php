<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  require_once("dbcon/dbcon.php");
	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta charset="utf-8">
<title>Duplicate Invoice</title>
<script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>
<style> @media only print
{
    footer, header, .sidebar{ display:none; }
}  
</style>
<style type="text/css" media="print">
.dontprint
{ display: none; }
</style>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
	margin-bottom: 0mm;
}
</style>
</head>
<body style="margin:0px;" onload="printpage();">
<?php 
date_default_timezone_set("Asia/Kolkata");
	$todayTime=date('d-M-Y h:i:s A');

$currentInvoiceNo=$_GET['invoiceNo'];
$customerId=$_GET['customerId'];
if($customerId!="")
	{
$sql1="select * from customer where id='$customerId'";
	$query1=mysqli_query($dbhandle,$sql1);
	}
	else
	{
		$sql1="select * from fullpaidcustomer where invoiceNo='$currentInvoiceNo'";
	$query1=mysqli_query($dbhandle,$sql1);
	}
	while($row1 = mysqli_fetch_array($query1))
	{
	$name=$row1['name'];
	$phone=$row1['phone'];
	$email=$row1['email'];
	$address=$row1['address'];
	}
	

	
$query2 = mysqli_query( $dbhandle,"select * from invoice where invoiceNo='$currentInvoiceNo'");
$row2 = mysqli_fetch_assoc($query2);
$serialNos=$row2['serialNos'];
$entryDate=$row2['dateTime'];
$totalSellingPrice=$row2['prices'];

$value5=explode("/",$serialNos);

for($i=0;$i<=0;$i++)
{
	$serialNoForSalesPerson=$value5['0'];
}

$sql8="select name from admin where username in (select username from sold where serialNo='$serialNoForSalesPerson')";
		$query8=mysqli_query($dbhandle,$sql8);
		while($op=mysqli_fetch_array($query8))
		{
			$salesPerson=$op['name'];
		}
?>
<form><br />

<table width="98%" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" colspan="3"><?php require_once('sellersInfo.php');?><br />
ORIGINAL BUYER'S COPY / DUPLICATE SELLER'S COPY
<br />
<b><font size="+2">Duplicate Retail Invoice</font></b></td>
</tr>
  <tr>    
    <td  width="50%" rowspan="3">&nbsp;Buyer's Name and Address : 
      <br />
      <b>&nbsp;<?php echo strtoupper($name);?></b><br />
      <br />
        &nbsp;<?php echo  strtoupper($address);?><br />
        <br />
    &nbsp;Mobile :<b><?php echo $phone;?></b> <br />
    <?php if($email!=""){?>
&nbsp;Email: <b><?php echo $email;?><br /><?php }?>    <br /></td>
    <td  width="25%" align="left">Invoice No. :<br /><b><?php echo  strtoupper($currentInvoiceNo);?></b></td>
    
    <td  width="25%" align="left">Purchased on :<br /><b><?php echo $entryDate;?></b></td>
  </tr>
  <tr>
  <td colspan="2" align="left">Sales Person:<br /><b><?php echo  strtoupper($salesPerson);?></b></td>
  </tr>
  <tr>
  <td colspan="2">Reprint Date &amp; Time :<b>&nbsp;<?php echo $todayTime;?></b></td>
  </tr>
  

  <tr>
  <td colspan="3">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr >
  	<td width="3%" align="left">&nbsp;Sl &nbsp;No.</td>
    <td align="left" width="46%">Description of Goods</td>
    <td align="right" width="15%">Serial No.</td>
    <td align="right" width="15%">Rate(Rs.)</td>
    <td align="right" width="6%">VAT(%)</td>
    <td align="right" width="15%">Amout (Rs.)</td>
  </tr>



  <?php 
  
  foreach($value5 as $data1)
  {
	  $sql6="select * from serialno where serialNo='$data1' limit 1";
		$query6=mysqli_query($dbhandle,$sql6);
	  $sql7="select * from sellingprice where serialNo='$data1' limit 1";
		$query7=mysqli_query($dbhandle,$sql7);
		while($op=mysqli_fetch_array($query7))
		{
			$productPricesWithVat.=$op['price']."/";
			
		}
		
		while($op=mysqli_fetch_array($query6))
		{
			$productName=$op['productName'];
			$categorySubCategory=$op['categorySubCategory'];
			$vatEach=$op['vat'];
			$vats.=$vatEach."/";
			$productPricesWithOutVat.=$op['price']."/";
			$productNamesForInvoice.=$op['productName']."/";
		}
  }
  $value1=explode("/",$productNamesForInvoice);
  $value2=explode("/",$productPricesWithOutVat);
  $value3=explode("/",$vats);
  $value4=explode("/",$productPricesWithVat);
  
  $count=count($value5);
  $count--;
  //echo $count;
  $i=0;
  ?>
  
   
      <tr>
      <td align="left"><?php for($k=0;$k<$count;$k++)
	{$i++;echo str_repeat('&nbsp;', 1).$i."<br />"; }?>
        <br />
       
      <td align="left"><?php for($k=0;$k<$count;$k++){ echo "<b>&nbsp;".strtoupper($value1[$k])."</b><br />";}?>
        <br /></td>
    <td align="right"><?php for($k=0;$k<$count;$k++){ echo "<b>".$value5[$k]."</b><br />";}?> <br /></td>
    <td align="right"><?php for($k=0;$k<$count;$k++){ echo "<b>".number_format((float)$value2[$k], 2, '.', '')."</b><br />";}?> <br /></td>
    <td align="right"><?php for($k=0;$k<$count;$k++){ echo "<b>".$value3[$k]."</b><br />";}?> <br /></td>
    <td align="right"><?php for($k=0;$k<$count;$k++){ echo "<b>".number_format((float)$value4[$k], 2, '.', '')."</b><br />";}?> <br /></td>
  </tr>

  </table>
  </td>
   </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <th scope="col" colspan="2" align="right" width="75%"><?php
 echo "Total Amount ";
?>(in Rs.) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php echo $totalSellingPrice;?>/-</th>
  </tr>
   <tr>
    <td colspan="3">Amount(in words) : - <b>
        <?php require_once('numberToWords.php');?></b><br />
</td>
  </tr>
  <tr>
     <td colspan="3" align="center">
     <table width="100%" border="1" cellspacing="0" cellpadding="0">
       <tr>
         <th scope="col" align="center" width="33%"><br />
           <br />
           <br />
           <?php
	  		echo str_repeat('-', 43);
	  ?>
           <br />
          Checked By</th>
         <th scope="col" align="center" width="33%"><br />
           <br />
           <br />
           <?php 
	  		echo str_repeat('-', 43);
	  ?>
           <br />
          <?php echo $shopNameHeader;?></th>
         <th scope="col" align="center" width="34%"><br />
           <br />
           <br />
           <?php 
	  		echo str_repeat('-', 44);
			
			 ?>
           <br />
           Receiver's Signature</th>
       </tr>
     </table>
      </td>
  </tr>
   
    <tr>
    <td colspan="3"><font size="-2">Declaration :<b>We have sold the above mentioned items in their original OEM packng as received by us from our suppliers and vendors. We have not changed the nature of the goods by any mean including loading of any softwares,integration etc. Any changes done by you or your agent is solely at your risk and responsibility. We cannot be liable for any cost or damages for any act done by you or your agent.</b></font></td>
  </tr>
    <tr>
    <td colspan="3"><b><font size="-1">For any Queries,Comments &amp; Opinions call     : <?php echo $shopQueryComplainNo;?><br />
      For any complaints/suggestions, pls mail at : <?php echo $shopEmail;?>
    </font></b>
    </td>
  </tr>
</table>

</form>

<div align="right" class="dontprint">
<center>
<a href="admHome.php">Home Page</a><br /><br />
Refresh the page again if Page Printing doesn't appears(Press F5)
</center>
</div>
</body>
</html>
<?php
}//end if
else
{
	header('location:index.php');
}
?>

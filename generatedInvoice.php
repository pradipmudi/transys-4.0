<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
{
	$customerType=$_POST['customerType'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$currentInvoiceNo=$_POST['currentInvoiceNo'];
	$todayDate=$_POST['todayDate'];
	$salesPerson=$_POST['salesPerson'];
	$todayTime=$_POST['todayTime'];
	$nextInstallmentDate=$_POST['nextInstallmentDate'];
	$productNamesForInvoice=$_POST['productNamesForInvoice'];
	$productPricesWithOutVat=$_POST['productPricesWithOutVat'];
	$vats=$_POST['vats'];
	$productPricesWithVat=$_POST['productPricesWithVat'];
	$serialNos=$_POST['serialNos'];
	$totalSellingPrice=$_POST['totalSellingPrice'];
	$creditedAmount=$_POST['creditedAmount'];
	$totalAmount=$_POST['totalAmount'];
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Invoice</title>
<script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>
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
<form><br />
<table width="90%" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" colspan="3"><?php require_once('sellersInfo.php');?><br />
ORIGINAL BUYER'S COPY / DUPLICATE SELLER'S COPY
<br />
<b><font size="+2">Retail Invoice</font></b></td>
</tr>
  <tr>    
    <td  width="75%" rowspan="3">&nbsp;Buyer's Name and Address : 
      <br />
      <b>&nbsp;<?php echo strtoupper($name);?></b><br />
      <br />
        &nbsp;<?php echo  strtoupper($address);?><br />
        <br />
    &nbsp;Mobile :<b><?php echo $phone;?></b> <br />
    <?php if($email!=""){?>
&nbsp; Email: <b><?php echo $email;?><br /><?php }?>    <br /></td>
    <td  width="50%" align="left">Invoice No. :<br /><b><?php echo  strtoupper($currentInvoiceNo);?></b></td>
    
    <td  width="50%" align="left">Dated :<br /><b><?php echo $todayDate;?></b></td>
  </tr>
  <tr>
  <td colspan="2" align="left">Sales Person:<br /><b><?php echo  strtoupper($salesPerson);?></b></td>
  </tr>
  <tr>
  <td colspan="2">Time :<b>&nbsp;<?php echo $todayTime;?></b></td>
  </tr>
  

  <tr>
  <td colspan="3">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr >
  	<td width="3%" align="left">&nbsp;Sl &nbsp;No.</td>
    <td align="left" width="46%">Description of Goods</td>
    <td align="right" width="15%">Serial No.&nbsp;</td>
    <td align="right" width="15%">Rate(Rs.)&nbsp;</td>
    <td align="right" width="6%">VAT(%)&nbsp;</td>
    <td align="right" width="15%">Amout (Rs.)&nbsp;</td>
  </tr>



  <?php 
  $value1=explode("/",$productNamesForInvoice);
  $value2=explode("/",$productPricesWithOutVat);
  $value3=explode("/",$vats);
  $value4=explode("/",$productPricesWithVat);
  $value5=explode("/",$serialNos);
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
    <td align="right"><?php for($k=0;$k<$count;$k++){ echo "<b>".number_format((float)($value4[$k]-($value4[$k]*$value3[$k]/100)), 2, '.', '')."</b><br />";}?> <br /></td>
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
    <th scope="col" colspan="2" align="right" width="75%">       Total Amount (Rs.) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php echo $totalSellingPrice;?> /-</th>
  </tr>
<?php  
  //if($customerType=="creditCustomer")
  {
  ?>
<!--  <tr>
    <th scope="col" colspan="2" align="right" width="75%">       Paid (Rs.) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php //echo $creditedAmount;?> /-</th>
  </tr>
  <tr>
    <th scope="col" colspan="2" align="right" width="75%">      Amount to be Paid (Rs.) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php //echo $totalAmount;?> /-</th>
  </tr> -->
<?php 
  }
?>  
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
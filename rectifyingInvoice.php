<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']) && isset($_SESSION['user']))
{
	$existing=$_GET['existing'];
	$existingCreditCustomerID=$_GET['id'];
	$existingCreditTable="cust".$existingCreditCustomerID;
	$customerType=$_POST['customerType'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$newfilename = $_POST['file'];
	$serialNoArray=$_POST['serialNoArray'];	
	$priceArray=$_POST['priceArray'];
	$stockArray=$_POST['stockArray'];
	$productQuantity=$_POST['productQuantity'];
	$previousBalanceDue=$_POST['previousBalanceDue'];
	$nextInstallmentDate=$_POST['dob'];
	
	$profitMultiyear=$_POST['profitMultiyear'];
	$profitSingleyear=$_POST['profitSingleyear'];
	$profitMonth=$_POST['profitMonth'];
	$profitDate=$_POST['profitDate'];
	$dateOfPreviousEntry=$profitDate;
	$explodeProfitDate=explode("-",$profitDate);
	$profitMonthYearName=$explodeProfitDate[0]."-".$explodeProfitDate[1];
	$profitYearName=$explodeProfitDate[0];
	
	$totalSellingPrice=0; //total price of the products including vat 
	$totalProfit=0; //total profit to be calculated
	$eachProfit=0; //profit on each product
	$totalPurchasePrice=0; //purchased price of products
	$sql0="select * from admin where username='".$_SESSION['user']."'";
	
		$query0=mysqli_query($dbhandle,$sql0);
		while($op=mysqli_fetch_array($query0))
		{
			$salesPerson=$op['Name'];
		}
		
	foreach(array_keys($serialNoArray) as $key)
	{
		$dataSerial=$serialNoArray[$key];
		$dataPrice=$priceArray[$key];
		$sql="select * from serialno where serialNo='$dataSerial' and soldStatus='no' limit 1";
		$query=mysqli_query($dbhandle,$sql);
		
		while($op=mysqli_fetch_array($query))
		{
			$price=$op['price'];
			$totalPurchasePrice+=$price;
			$eachProfit=$dataPrice-$price;
			$totalProfit+=$eachProfit;
			$eachProfit=0;
			
		}
		
	}
	foreach($priceArray as $dataPrice)
	{
		$totalSellingPrice+=$dataPrice;
	}
//$totalProfit=$totalSellingPrice-$totalPurchasePrice;
	$serialNos="";
	$tax=$totalSellingPrice-$totalProfit; //tax calculated
	$productPricesWithVat="";
	foreach($serialNoArray as $value)
	{
		$serialNos.=$value."/";
	}
	foreach($priceArray as $val)
	{
		$productPricesWithVat.=$val."/";
	}
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d'); // to be entered/updated in the profitSingleYear table
	$todayProfitMonthYear=date('Y-m'); //  to be entered/updated in the profitSingleYear table
	$todayProfitYear=date('Y'); //  to be entered/updated in the profitMultiYear table

	$todayDate=date('d-m-Y');
	$todayTime=date('h:i:s A');
	$entryDate=date('Y-m-d H:i:s');
	$invoiceName="inv".$date; // invoice on todays date
	$billDate=date("UYmjHis");
	
	
	$query1="select * from invoice order by invoiceNo desc limit 1";
	$saveval1=mysqli_query($dbhandle,$query1);
	$no=mysqli_num_rows($saveval1);
	//echo $no;
	while($op=mysqli_fetch_array($saveval1))
	{
		
		$invoiceNo=explode("/",$op['invoiceNo']); //invoice date last entered
		
	}
	$day=$invoiceNo[0];
		$i=1;
	if(strcmp($invoiceName,$invoiceNo[0])==0)
	{
		$billNo=$invoiceNo[1]+$i;
		$currentInvoiceNo=$invoiceNo[0]."/".$billNo;
	
	}
	else if(strcmp($invoiceName,$invoiceNo[0])>0)
	{
		$billNo=1;
		$currentInvoiceNo=$invoiceName."/".$billNo;
	}
	else
	{
		//header('location:customerType.php?error_code=1');
	}


	/*	$sql2="INSERT INTO invoice "."VALUES('','$date','$customerType','$serialNos','$totalSellingPrice','$currentInvoiceNo','$totalProfit','$tax')";
		//echo $sql2;
		$query2=mysqli_query($dbhandle,$sql2);*/
		$vats="";
		$productNamesForInvoice="";
		$productPricesWithOutVat="";
		foreach(array_keys($serialNoArray) as $key1)
		{
		$data1=$serialNoArray[$key1];
		$data2=$priceArray[$key1];
		$stock=$stockArray[$key1];
		
		//"UPDATE `sellingprice` SET `price` = '$data2' WHERE id IN ( SELECT id FROM (SELECT id FROM sellingprice where `sellingprice`.`serialNo` = $data1 ORDER BY id ASC LIMIT 1 ) tmp )";
		$sql3="UPDATE `serialno` SET `soldStatus` = 'yes' WHERE id IN ( SELECT id FROM (SELECT id FROM serialNo where `serialno`.`serialNo` = $data1 and `soldStatus` = 'no' ORDER BY id ASC LIMIT 1 ) tmp )";
		
		$sql4="UPDATE `sellingprice` SET `status` = 'yes' WHERE id IN ( SELECT id FROM (SELECT id FROM sellingprice where `sellingprice`.`serialNo` = $data1 and `status` = 'no' ORDER BY id ASC LIMIT 1 ) tmp )";

		$sql5="UPDATE `sellingprice` SET `price` = '$data2' WHERE id IN ( SELECT id FROM (SELECT id FROM sellingprice where `sellingprice`.`serialNo` = $data1 ORDER BY id ASC LIMIT 1 ) tmp )";
		$sql6="select * from serialno where serialNo='$data1' and soldStatus='no' limit 1";
		$query6=mysqli_query($dbhandle,$sql6);
		
		while($op=mysqli_fetch_array($query6))
		{
			$productName=$op['productName'];
			echo "productName= ".$productName."<br /><br />";
			$categorySubCategory=$op['categorySubCategory'];
			$vatEach=$op['vat'];
			$vats.=$vatEach."/";
			$eachProductWOvat=$data2-$data2*$vatEach;
			$productPricesWithOutVat.=$eachProductWOvat."/";
			$productNamesForInvoice.=$op['productName']."/";
		}
		$sql7="INSERT INTO sold "."VALUES('','$productName','$data1','$data2','".$_SESSION['user']."','$entryDate','$categorySubCategory','$vatEach')";
		$sql8="select * from stock where name='$productName'";
		$query8=mysqli_query($dbhandle,$sql8);
		//while($fetch=mysqli_fetch_array($query8))
		//{
		//	$quantity=$fetch['quantity'];
		//}
		$quantity=$stock-1;
		$sql9="UPDATE `stock` SET `quantity` = '$quantity' WHERE `stock`.`name` = '$productName'";
		$query9=mysqli_query($dbhandle,$sql9);
		$query3=mysqli_query($dbhandle,$sql3);
		$query4=mysqli_query($dbhandle,$sql4);
		$query5=mysqli_query($dbhandle,$sql5);
		$query7=mysqli_query($dbhandle,$sql7);
		}
		if($customerType=='fullPaid')
		{
		
		if($id=="")$id="";
		$sql2="INSERT INTO invoice "."VALUES('','$date','$customerType','$serialNos','$totalSellingPrice','$currentInvoiceNo','$totalProfit','$tax','$id')";
		$query2=mysqli_query($dbhandle,$sql2);
		$sql14="select * from invoice order by invoiceNo desc limit 1";
		$query14=mysqli_query($dbhandle,$sql14);
		while($fetchit=mysqli_fetch_array($query14))
		{
			$currentFullPaidCustInvoice=$fetchit['invoiceNo'];
		}

		$sql10="INSERT INTO fullpaidcustomer "."VALUES('$currentFullPaidCustInvoice','$name','$address','$phone','$email')";
		$query10=mysqli_query($dbhandle,$sql10);
		}
		else
		{
			

if($existing==1)
	{
		$currentBalanceDue=$totalSellingPrice+$previousBalanceDue;
		$sql13 = "UPDATE `customer` SET `balance` = '$currentBalanceDue',nextInstallmentDate='".$nextInstallmentDate."' WHERE `customer`.`id` = '$existingCreditCustomerID'";
		
		$query13 = mysqli_query($dbhandle,$sql13 );
	}
else
	{
		$sql13 = "INSERT INTO customer "."VALUES('','$name','$address','$phone','$newfilename','$totalSellingPrice','$email','$nextInstallmentDate')";
		
		$query13 = mysqli_query($dbhandle,$sql13);
	}
		
$query2 = "select * from customer order by id desc limit 1";
		
		$saveval2 = mysqli_query($dbhandle,$query2);
$num=mysqli_num_rows($query2);
if($num>0)
{
	
}
else
{
	while($fetch=mysqli_fetch_array($saveval2))
	{
		$id=$fetch['id'];
	}
	$tableName="cust".$id;
}
// ------------------- credit customer payment history -------------------//
	


	$description=$_POST['description'];
	$creditedAmount=abs($_POST['credit']);
	$todayDateTime=date('Y-m-d H:i:s');
	
		
	

	
	
	if($existing==1)
	{
		$sql1="select * from customer where id='".$existingCreditCustomerID."'";
	$query1=mysqli_query($dbhandle,$sql1);
	while($op=mysqli_fetch_assoc($query1))
	{
		$previousBalanceDue=$op['balance'];
	}
	$currentDebitBalanceDue=$previousBalanceDue-$creditedAmount;
		
		$sql11="INSERT INTO ".$existingCreditTable." "."VALUES('','$entryDate','$currentInvoiceNo','$totalSellingPrice','0')";	
	$query11=mysqli_query( $dbhandle,$sql11);

	
	$sql2="update `customer` set balance='".$currentDebitBalanceDue.",nextInstallmentDate='".$nextInstallmentDate."' where id='".$existingCreditCustomerID."'";
	$query2=mysqli_query($dbhandle,$sql2);
	$sql3="INSERT INTO ".$existingCreditTable." "."VALUES('','$todayDateTime','$description','0','$creditedAmount')";
	$query3=mysqli_query($dbhandle,$sql3);
	}
	else
	{
	$saveval3 = mysqli_query( $dbhandle,"CREATE TABLE `".$db."`.`".$tableName."` (`id` bigint(10) NOT NULL AUTO_INCREMENT, `dateTime` datetime NOT NULL, `description` varchar(150) NOT NULL,  `debit` double NOT NULL,  `credit` double NOT NULL, PRIMARY KEY (`id`))");
	
	$sql1="select * from customer where id='".$id."'";
	$query1=mysqli_query($dbhandle,$sql1);
	while($op=mysqli_fetch_assoc($query1))
	{
		$previousBalanceDue=$op['balance'];
	}
	$currentDebitBalanceDue=$previousBalanceDue-$creditedAmount;
	
	$sql11="INSERT INTO ".$tableName." "."VALUES('','$entryDate','$currentInvoiceNo','$totalSellingPrice','0')";	
	$query11=mysqli_query( $dbhandle,$sql11);
	$sql1="select * from customer where id='".$id."'";
	$query1=mysqli_query($dbhandle,$sql1);
	while($op=mysqli_fetch_assoc($query1))
	{
		$previousBalanceDue=$op['balance'];
	}
	$currentDebitBalanceDue=$previousBalanceDue-$creditedAmount;
	
	
	
	$sql2="update `customer` set balance='".$currentDebitBalanceDue."',nextInstallmentDate='".$nextInstallmentDate."' where id='".$id."'";
	$query2=mysqli_query($dbhandle,$sql2);
	$sql3="INSERT INTO $tableName "."VALUES('','$todayDateTime','$description','0','$creditedAmount')";
	$query3=mysqli_query($dbhandle,$sql3);
}
// ------------------- credit customer payment history -------------------//	
	

if($id=="")$id=$existingCreditCustomerID;
$sql2="INSERT INTO invoice "."VALUES('','$date','$customerType','$serialNos','$totalSellingPrice','$currentInvoiceNo','$totalProfit','$tax','$id')";
		$query2=mysqli_query($dbhandle,$sql2);
	








		
		}
		
// ------- Profit data stored ------- \\	

	
if( ($date==$dateOfPreviousEntry) && ($todayProfitMonthYear==$profitMonthYearName) && ($todayProfitYear==$profitYearName) )
	{
		$currentMultiyearProfit=$profitMultiyear+$totalProfit;
		$currentSingleyearProfit=$profitSingleyear+$totalProfit;
		$currentMonthProfit=$profitMonth+$totalProfit;
		
		$sql14="UPDATE `profitsingleyear` SET `profit` = '$currentSingleyearProfit' WHERE `profitsingleyear`.`period` = '$profitMonthYearName'";
		$query14=mysqli_query( $dbhandle,$sql14);
		
		$sql15="UPDATE `profitmultiyear` SET `profit` = '$currentMultiyearProfit' WHERE `profitmultiyear`.`period` = '$profitYearName'";
		$query15=mysqli_query( $dbhandle,$sql15);
		
		$sql16="UPDATE `profitmonth` SET `profit` = '$currentMonthProfit' WHERE `profitmonth`.`period` = '$date'";
		$query16=mysqli_query( $dbhandle,$sql16);
		
	}
else if( ($date!=$dateOfPreviousEntry) && ($todayProfitMonthYear==$profitMonthYearName) && ($todayProfitYear==$profitYearName) )
{
		$currentMultiyearProfit=$profitMultiyear+$totalProfit;
		$currentSingleyearProfit=$profitSingleyear+$totalProfit;
		$sql14="UPDATE `profitsingleyear` SET `profit` = '$currentSingleyearProfit' WHERE `profitsingleyear`.`period` = '$profitMonthYearName'";
		$query14=mysqli_query( $dbhandle,$sql14);
		
		$sql15="UPDATE `profitmultiyear` SET `profit` = '$currentMultiyearProfit' WHERE `profitmultiyear`.`period` = '$profitYearName'";
		$query15=mysqli_query( $dbhandle,$sql15);
		
		$sql16="INSERT INTO profitmonth "."VALUES('$date','$totalProfit')";
		$query16=mysqli_query($dbhandle,$sql16);
}

else if( ($date!=$dateOfPreviousEntry) && ($todayProfitMonthYear!=$profitMonthYearName) && ($todayProfitYear==$profitYearName) )
{
		$currentMultiyearProfit=$profitMultiyear+$totalProfit;
		$sql14="UPDATE `profitmultiyear` SET `profit` = '$currentMultiyearProfit' WHERE `profitmultiyear`.`period` = '$profitYearName'";
		$query14=mysqli_query( $dbhandle,$sql14);
		
		$sql15="INSERT INTO profitsingleyear "."VALUES('$todayProfitMonthYear','$totalProfit')";
		$query15=mysqli_query($dbhandle,$sql15);
		
		$sql16="INSERT INTO profitmonth "."VALUES('$date','$totalProfit')";
		$query16=mysqli_query($dbhandle,$sql16);
}
else
	{
		$sql14="INSERT INTO profitmultiyear "."VALUES('$todayProfitYear','$totalProfit')";
		$query14=mysqli_query($dbhandle,$sql14);
		
		$sql15="INSERT INTO profitsingleyear "."VALUES('$todayProfitMonthYear','$totalProfit')";
		$query15=mysqli_query($dbhandle,$sql15);
		
		$sql16="INSERT INTO profitmonth "."VALUES('$date','$totalProfit')";
		$query16=mysqli_query($dbhandle,$sql16);
	}
if($customerType=="creditCustomer")
$totalAmount=$totalSellingPrice-$creditedAmount;
else
$totalAmount=$totalSellingPrice;
// ------- Profit data stored ------- \\

		mysqli_close($dbhandle);
	
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
<style> @media only print
{
    footer, header, .sidebar{ display:none; }
}  </style>
</head>
<body style="margin:0px;" >
<form method="post" action="generatedInvoice.php" enctype="multipart/form-data" name="invoiceData">
<table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center" colspan="3"><?php require_once('sellersInfo.php');?><br />
ORIGINAL BUYER'S COPY / DUPLICATE SELLER'S COPY
<br />
<b><font size="+2"><input type="hidden" name="customerType" value="<?php echo $customerType;?>">Retail Invoice</font></b></td>
</tr>
  <tr>    
    <td  width="75%" rowspan="3">Buyer's Name and Address : 
      <br />
      <b><?php echo strtoupper($name);?></b><input type="hidden" name="name" value="<?php echo strtoupper($name);?>" /><br />
      <br />
        <?php echo  strtoupper($address);?>
        <input type="hidden" name="address" value="<?php echo strtoupper($address);?>" />
        <br />
        <br />
    Mobile :<b><?php echo $phone;?></b> <input type="hidden" name="phone" value="<?php echo $phone;?>" />
    <br />
    <?php if($email!=""){?>
Email: <b><?php echo $email;?>
<input type="hidden" name="email" value="<?php echo $email;?>" />
<br /><?php }?>    <br /></td>
    <td  width="50%" align="left">Invoice No. :<br /><b><?php echo  strtoupper($currentInvoiceNo);?>
      <input type="hidden" name="currentInvoiceNo" value="<?php echo strtoupper($currentInvoiceNo);?>" />
    </b></td>
    
    <td  width="50%" align="left">Dated :<br /><b><?php echo $todayDate;?>
      <input type="hidden" name="todayDate" value="<?php echo strtoupper($todayDate);?>" />
    </b></td>
  </tr>
  <tr>
  <td colspan="2" align="left">Sales Person:<br /><b><?php echo  strtoupper($salesPerson);?>
    <input type="hidden" name="salesPerson" value="<?php echo strtoupper($salesPerson);?>" />
  </b></td>
  </tr>
  <tr>
  <td colspan="2">Time :<b>&nbsp;<?php echo $todayTime;?>
    <input type="hidden" name="todayTime" value="<?php echo strtoupper($todayTime);?>" />
  </b></td>
  </tr>
  

  <tr>
  <td colspan="3">
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr >
  	<td width="3%" align="left">Sl No.</td>
    <td align="left" width="46%">Description of Goods</td>
    <td align="right" width="15%">Serial No.</td>
    <td align="right" width="15%">Rate(₹)</td>
    <td align="right" width="6%">VAT(%)</td>
    <td align="right" width="15%">Amout (₹)</td>
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
    <th scope="col" colspan="2" align="right" width="75%">       Total Amount (₹) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php echo $totalSellingPrice;?> /-<b>
      <input type="hidden" name="totalSellingPrice" value="<?php echo $totalSellingPrice;?>" />
    </b></th>
  </tr>
<?php  
  if($customerType=="creditCustomer")
  {
  ?>
  <tr>
    <th scope="col" colspan="2" align="right" width="75%">       Paid (₹) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php echo $creditedAmount;?> /-<b>
      <input type="hidden" name="creditedAmount" value="<?php echo $creditedAmount;?>" />
    </b></th>
  </tr>
  <tr>
    <th scope="col" colspan="2" align="right" width="75%">      Amount to be Paid (₹) : &nbsp;&nbsp;</th>
    <th scope="col" width="25%"><?php echo $totalAmount;?> /-<b>
      <input type="hidden" name="totalAmount" value="<?php echo $totalAmount;?>" />
      <input type="hidden" name="nextInstallmentDate" value="<?php echo $nextInstallmentDate;?>" />
    </b></th>
  </tr>
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
           <input type="hidden" name="productNamesForInvoice" value="<?php echo $productNamesForInvoice;?>">
<input type="hidden" name="productPricesWithOutVat" value="<?php echo $productPricesWithOutVat;?>">
<input type="hidden" name="vats" value="<?php echo $vats;?>">
<input type="hidden" name="productPricesWithVat" value="<?php echo $productPricesWithVat;?>">
<input type="hidden" name="serialNos" value="<?php echo $serialNos;?>">
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
<br />
<center><input type="button" value="Print" onClick="window.print()" >
&nbsp;<a href="admHome.php">Back to Homepage</a></center>
</form>
</body>
</html>
<?php
}//end if
else
{
	header('location:index.php');
}
?>



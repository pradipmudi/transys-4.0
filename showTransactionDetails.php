<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
	  date_default_timezone_set("Asia/Kolkata");
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
	  $transactionTableName="cust".$_GET['id'];
	  $sql="select * from $transactionTableName order by dateTime asc";
	  $query=mysqli_query($dbhandle,$sql);
	  $sql2="select * from callcustomer where CustomerId='".$_GET['id']."' order by callTime desc";
	  $query2=mysqli_query($dbhandle,$sql2);
	  $no=mysqli_num_rows($query);
	  $totalCall=mysqli_num_rows($query2);
	  
	  if(isset($_POST['callMade']))
  		{
			$customerId=$_POST['customerId'];
			$callTime=date('Y-m-d H:i:s');
			$sql3="INSERT INTO callcustomer "."VALUES('','$customerId','$callTime','".$_SESSION['user']."')";
			$query3=mysqli_query($dbhandle,$sql3);
			header('location:showTransactionDetails.php?id='.$customerId.'');
		}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Credit Customer Transactions</title>

<?php 
$date=date('d-M-Y');
?>
<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<script type="text/javascript">
function validate()
{



	var dob1=document.customerPayment.dob.value	;   
   if( document.customerPayment.dob.value == "" )
   {
     alert( "Please provide purchase Date !!" );
     document.customerPayment.dob.focus() ;
     return false;

   }else
   {
  // alert(dob1);
   var res = dob1.split("-"); 
  //  alert(res[0]);
	 if(res[1]=="Jan")
     {
	  month = 01;
	  }
	  else if( res[1]=="Feb")
	     {
		  month =02;
		 }
		 else if( res[1]=="Mar")
	     {
		  month = 03;
		 }
		 else if( res[1]=="Apr")
	     {
		  month = 04;
		 }
		 else if( res[1]=="May")
	     {
		  month = 05;
		 }
		 else if( res[1]=="Jun")
	     {
		  month = 06;
		 }
		 else if( res[1]=="Jul")
	     {
		  month = 07;
		 }
		 else if( res[1]=="Aug")
	     {
		  month = 08;
		 }
		 else if( res[1]=="Sep")
	     {
		  month = 09;
		 }
		 else if( res[1]=="Oct")
	     {
		  month = 10;
		 }
		 else if( res[1]=="Nov")
	     {
		  month = 11;
		 }
		 else if( res[1]=="Dec")
	     {
		  month = 12;
		 }
		var actualday =  res[2]+"-"+month+"-"+res[0];
	//alert(actualday);
	document.customerPayment.dob.value=actualday;
		/* var today = new Date();
         var dd = today.getDate();
	     var mm = today.getMonth()+1;
	     var yyyy = today.getFullYear();
	     var today = dd+'-'+mm+'-'+yyyy;
		// alert(today);
		 var def= yyyy - res[2];
		 if(def<16)
	      {
	       alert("The date of birth you are typing is not valid!!!!");
	       document.reg.dob.value="" ;
	       document.reg.dob.focus() ;
	       return false;
	        }*/
    }
}
</script>
</head>			

<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br>
<br>

<table width="90%" border="1" cellspacing="0" cellpadding="2" align="center">
  <tr bgcolor="#CCCCCC">
    <td align="center" width="65%">
    <font size="+2"><b>Account  Details:</b></font>
    </td>
    <td align="center" width="35%">
    <font size="+2"><b>New Payment Here</b></font>
    <font color="#009933">
<?php
error_reporting(0); 
$success=$_GET['success'];
$invalid_file=$_GET['invalid_file'];
if($success==1)
	{
	echo "<br />Payment details have been updated successfully!";
	}
?>
</font>
    </td>
  </tr>
  <tr>
   	<td colspan="1">
    <!----- Buyer's Information Table(Start) ----->
    <?php 
			$sql1="select * from customer where id='".$_GET['id']."'";
			$query1=mysqli_query($dbhandle,$sql1);
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#EDF1EE">
    <td colspan="2" align="center"><b><font size="+1">Buyer's Information</font></b></td>
    </tr>
  <tr>
    <td>
    <?php
	while($op=mysqli_fetch_assoc($query1))
	{
		echo "<b>".strtoupper($op['name'])."</b><br /><br />";
		echo "<b>".strtoupper($op['address'])."</b><br /><br />";
		echo "Mobile : <b>".$op['phone']."</b><br />";
		if($op['email']=="") $email="Not available";
		else $email=$op['email'];
		echo "Email &nbsp;&nbsp;: <b>".$email."</b><br />";
		echo "Balance Due 	: <b><font color=\"#07B603\">&#x20b9;</font> ".number_format((float)$op['balance'], 2, '.', '')."</b><br />";
		echo "Next Installment on : <b>".$op['nextInstallmentDate']."</b><br />";
		$picName=$op['photo'];
		$balanceDue=$op['balance'];
	}
	
	?>
    </td>
    <td><br>
<img src="custProfilePic/<?php echo $picName;?>" height="213.33" width="165"/></td>
  </tr>
  <tr>
  <td colspan="2" align="center">
  <br>&nbsp;&nbsp;
  <form name="f1" method="post" enctype="multipart/form-data" action="editCustomerDetails.php">
  <input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
  <input type="submit" value="Edit Customer Personal Information" name="edit" style="height:30px;">
  </form>
  <br>
  </td>
  </tr>
</table>

    
    <!----- Buyer's Information Table(End) ----->
    
   	</td>
    
    <td>
    <?php 
	if($balanceDue>0)
	{
	?>
     <!-- New Payment Table (Start) -->
  
  <form method="post" name="customerPayment" enctype="multipart/form-data" action="saveAmountCredited.php?id=<?php echo $_GET['id'];?>" onsubmit="return(validate());">
  <table width="100%" border="0" cellspacing="4" cellpadding="0" bgcolor="#E3E6E6">
	
  <tr>
    <th scope="col" align="left">&nbsp;Payment Description :</th>
    <td align="left"><textarea placeholder="Enter Payment Description Here" id="description" name="description" rows="3" cols="20"   required></textarea>
    </td>
  </tr>

  <tr>
    <th scope="col" align="left">&nbsp;Amount Paid :</th>
    <td align="left"><input type="text" name="credit" placeholder="Amount Credited" required></td>
  </tr>

<tr>
  <td colspan="1"><b>&nbsp;Next Installment :</b></td>
  <td align="left"><input type="text" name="dob"   id="date" placeholder="Next Installment Date" value="0000-00-00"  required />
    <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>

   <tr>
    <td colspan="2" align="center"><br>      <input type="submit" name="save" value="Save Payment"></td>
    </tr>
</table>

  </form>

  
  <!-- New Payment Table (End-) -->
  
  <br>
  <form name="call" action="showTransactionDetails.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr bgcolor="#CCCCCC">
    <th scope="col" align="left"><font color="#006600">Any call made to the customer recently?</font><br><font color="#FF0000">Then,click on the tick!</font></th>
    <th scope="col" width="4%">
    <input type="submit" value="&#10003;" name="callMade" style="font-size:18px; color:#0C0;">
    <input type="hidden" value="<?php echo $_GET['id'];?>" name="customerId">
    </th>
  </tr>
</table>
  </form>
  <?php 
  }
  else
  {
	  echo "Account has been fully setteled. No new payments can be made till new purchase.";
  }
	  
  ?>
  

  </td>
  </tr>
  
  <tr>
  <td>
  
 <!-- Account Details Table (Start) -->
  <div style="height:200px;overflow-y:auto">
<table width="100%" border="0" cellspacing="4" cellpadding="0" >
<tr bgcolor="#666666">
  	  <th colspan="5" scope="col">Transaction Details</th>
 </tr>
  <tr bgcolor="#999999">
  	  <th scope="col" width="3%">Sl No.</th>
    <th scope="col" width="22%">Date and Time</th>
    <th scope="col" width="45%">Description</th>
    <th scope="col" width="15%">Debit</th>
    <th scope="col" width="15%">Credit</th>
  </tr>
  <?php 
  if($no>0)
  {
	  $i=1;
  while($op=mysqli_fetch_assoc($query))
  {
  ?>
  <tr>
  	<td>
    <?php echo "&nbsp;".$i; $i++;?>
  	</td>  
    <td align="right"><?php echo $op['dateTime']."&nbsp;";?></td>
    <td align="left"><?php echo "&nbsp;&nbsp;".strtoupper($op['description']);?></td>
    <td align="right"><?php echo number_format((float)$op['debit'], 2, '.', '')."&nbsp;";?></td>
    <td align="right"><?php echo number_format((float)$op['credit'], 2, '.', '')."&nbsp;";?></td>
  </tr>
  <?php }
  }
  else
  {
  ?>
  <tr><td colspan="5" align="center"><font color="#FF0000"><b>No Records Found</b></font></td></tr>
  <?php }?>
</table>
</div>
 <!-- Account Details Table (End) -->
 
  </td>
  <td>
  <div style="height:200px;overflow-y:auto">
  <table width="100%" border="0" cellspacing="4" cellpadding="0">
  <tr bgcolor="#666666">
    <th scope="col" colspan="2">Call Details(Total <font color="#1717C6"><?php echo $totalCall;?> calls</font> have been made)</th>
  </tr>
  <tr bgcolor="#999999">
    <th scope="col" width="20%">ID</th>
    <th scope="col">Call Time</th>
    </tr>
    <?php 
  if($totalCall>0)
  {
	  $i=1;
	  while($op=mysqli_fetch_assoc($query2))
	  {
  ?>
  <tr>
    <td align="center"><?php echo "&nbsp;&nbsp;".$i.".&nbsp;"?></td>
    <td align="center"><?php echo "&nbsp;".$op['callTime'];?></td>
    </tr>
  <?php
  		$i++;
	  }
  }
  else
  {
  ?>
  <tr>
    <td align="center" colspan="2"><font color="#FF0000"><b>No calls have been made yet!	</b></font></td>
  </tr>
 <?php
  }
 ?>
</table>
</div>

  </td>
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
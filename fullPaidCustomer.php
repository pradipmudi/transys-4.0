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
<title>Full Paid Customer</title>
<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<!-- ############## image preview ############### -->

</head>
<script type="text/javascript">
function validate()
{



	var dob1=document.pur.dob.value	;   
   if( document.pur.dob.value == "" )
   {
     alert( "Please provide purchase Date !!" );
     document.pur.dob.focus() ;
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
	document.pur.dob.value=actualday;
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
<?php require_once('backButton.php');?>
<body style="margin:0px;" >
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>
	<?php 
    $date=date('d-M-Y');
    ?>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>

<form name="customer" enctype="multipart/form-data" method="post" action="sellingDetails.php" onsubmit="return(validate());">
<table width="40%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr bgcolor="#000000">
    <td colspan="2" align="center"><h2><font color="#FFFFFF">Customer Details</font></h2></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><b><label for="name">Name:</label></b></td>
    <td align="left">
    <input type="text" name="name" id="name" placeholder="Enter the Customer Name" required></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><b>
    <label for="address">Email :</label></b></td>
    <td align="left"><input type="email" name="email" id="email" placeholder="Enter the E-mail here" ></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><b><label for="phone">Phone :</label></b></td>
    <td align="left"><input type="text" name="phone" id="phone" placeholder="Enter the Phone no. here" ></td>
  </tr>
 <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
   <tr>
    <td align="left"><b>
    <label for="email">Address :</label></b></td>
    <td align="left"><textarea placeholder="Enter the full address here" id="address" name="address" rows="5" cols="22"   style="resize:none;"  ></textarea></td>
  </tr>
 <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row" align="left"><b>Choose Date :</b></th>
    <td align="left" colspan="2"><input type="text" name="dob" value="<?php echo $date;?>"  id="date" placeholder="<?php echo $dateTime;?>"  required />
      <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="1" align="left"><b>
    <label for="quantity">Quantity of products to be sold:</label></b></td>
    <td colspan="1" align="left"><input type="text" name="quantity" id="quantity" placeholder="Enter Product quantity here " required ><input type="hidden" value="fullPaid" name="customerType"></td>
    </tr>
     <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="2" align="center"><input type="submit" name="save" value="Next" style="width: 100px; height:30px;">&nbsp;<button onclick="goBack()  ;" style="width: 100px; height:30px;">Back </button></td>   
  </tr>
</table>
</form>

</body>
</html>
<?php
  
  mysql_close($dbhandle);
}else{
	header('location:index.php');
}
 ?>
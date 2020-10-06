<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_SESSION['user']))
  {
	  $existing=$_GET['existing'];
	  $id=$_GET['id'];
	  $sql="select * from customer where id=".$id."";
	  $query=mysqli_query($dbhandle,$sql);
	  $no=mysqli_num_rows($query);
	  //echo "num=".$no." query=".$sql;
	  while($op=mysqli_fetch_assoc($query))
	  {
		  $name=$op['name'];		  
		  $address=$op['address'];
		  $photo=$op['photo'];
		  $phone=$op['phone'];
		  $email=$op['email'];
	  }
	  date_default_timezone_set("Asia/Kolkata");
	$entryDate=date('Y-m-d H:i:s');
	$billDate=date("UYmjHis");
	 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Credit Customer</title>


<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<!-- ############## image preview ############### -->




<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->

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
      //-->

      </script>
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
      
<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->
</head>
<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>
<form name="pur" enctype="multipart/form-data" method="post" action="sellingDetails.php?existing=<?php echo $existing;?>&id=<?php echo $id;?>" onsubmit="return(validate());">
<table  border="0" align="center">
  <tr bgcolor="#000000">
    <td colspan="2" align="center"><font color="#FFFFFF"> <h3><b><?php if($existing!=1)  echo "Add Credit"; else echo "Existing Credit";?> Customer Details</b></h3></font></td>
    
  </tr>
 <tr>
    <td align="center" colspan="2"><font color="#00FF00">
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
    <td align="left" colspan="1"><b>Name : </b></td>
    <td align="left" colspan="1"><input type="text" name="name" id="name" value="<?php if($existing==1) echo $name;	else echo ""; ?>" placeholder="Enter customer name"   required <?php if($existing==1) echo "readonly";?> /></td>
  </tr>
  <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Email :</b> </td>
    <td align="left" colspan="1"><input type="text" placeholder="Enter the email here" value="<?php 
	if($existing==1) echo $email;
	else {echo "";}
	?>" id="email" name="email" <?php if($existing==1) echo "readonly";?> /></td>
  </tr>
   <tr>
     <td align="center" colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td align="left" colspan="1"><b>Phone :</b></td>
     <td align="left" colspan="1"><input type="text" placeholder="Enter the phone number" value="<?php 
	if($existing==1) echo $phone;
	else { echo "";}
	?>" id="phone" name="phone" onkeypress="return isNumberKey2(event)" maxlength="12"   <?php if($existing==1) echo "readonly";?> /></td>
   </tr>
   <tr>
     <td align="center" colspan="2">&nbsp;</td>
   </tr>
   <?php if($existing!=1) { ?>
  <tr>
    <td align="left" colspan="1"><b>Upload Customer Photo :</b> </td>
    <td align="left" colspan="1"><input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
  <input name="file" type='file' value="<?php 
	if($existing==1) echo $photo;
	else { echo "";}
	?>" onchange="readURL(this);" /></td>
  </tr>
  <?php }?>
   <tr>
    <td align="center" colspan="2"><?php 
if($invalid_file==1)
	{
	echo "Invaid File!Please upload as image only.";
	}

?>&nbsp;</td>
    </tr>
    
	<?php 
    $date=date('d-M-Y');
    ?>
  <tr>
    <td align="left" colspan="1"><b>Address :</b> </td>
    <td align="left" colspan="1"><textarea placeholder="Enter the full address here" id="address" name="address" rows="5" cols="40"  style="resize:none;"  <?php if($existing==1) echo "readonly";?> ><?php 
	if($existing==1) echo $address;
	else { echo "";}
	?></textarea></td>
  </tr>
  <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
    
    <tr>
    <th scope="row" align="left"><b>Choose Date :</b></th>
    <td align="left" colspan="2"><input type="text" name="dob" value="<?php echo $date;?>"  id="date" placeholder="<?php echo $dateTime;?>"  required />
      <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
  </tr>
    <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
      
   <tr>
     <td align="left" colspan="1"><b>
     <label for="quantity">Quantity of products to be sold:</label>
     </b></td>
     <td align="left" colspan="1"><input type="text" name="quantity" id="quantity" required placeholder="Enter Product quantity here " >
      <input type="hidden" value="creditCustomer" name="customerType">
      <input type="hidden" value="<?php echo $billDate;?>" name="imageName"></td>
   </tr>
   <tr>
     <td align="center" colspan="2">&nbsp;</td>
   </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" name="save" value="Save"  /></td>
  </tr>
</table>
</form>
</body>
</html>
<?php 
}
else
{
	header('location:index.php');
}
?>
<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  require_once("dbcon/dbcon.php");
	  if(isset($_POST['update']))
  		{
			$id=$_POST['id'];
			$name=$_POST['name'];
			$address=$_POST['address'];
			$mobile=$_POST['mobile'];
			$email=$_POST['email'];
			$nextInstallmentDate=$_POST['dob'];
			$sql2="UPDATE `customer` SET `name` = '$name',`address`='$address',`phone`='$mobile',`email`='$email',`nextInstallmentDate`='$nextInstallmentDate' WHERE id='$id' ";
			$query2=mysqli_query($dbhandle,$sql2);
			header('location:showTransactionDetails.php?id='.$id.'&success=1');
		}
	  $id=$_POST['id'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit and Update Customer Data</title>
<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<script type="text/javascript">
function validate()
{



	var dob1=document.f1.dob.value	;   
   if( document.f1.dob.value == "" )
   {
     alert( "Please provide purchase Date !!" );
     document.f1.dob.focus() ;
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
	document.f1.dob.value=actualday;
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

<body>

    <!----- Buyer's Information Table(Start) ----->
    <?php 
			$sql1="select * from customer where id='".$id."'";
			$query1=mysqli_query($dbhandle,$sql1);
	?>
    <form name="f1" enctype="multipart/form-data" method="post" action="editCustomerDetails.php" onsubmit="return(validate());">
    
    <table width="60%" border="0" cellspacing="6" cellpadding="0" align="center">
  <tr bgcolor="#EDF1EE">
    <td colspan="3" align="center"><b><font size="+1">Edit and Update Buyer's Information</font></b></td>
    </tr>


    <?php
	$op=mysqli_fetch_array($query1);
	$picName=$op['photo'];
	?>
     <tr>
    <td align="left"><b>Name : </b></td>
    <td align="left"><input type="text" name="name" value="<?php echo strtoupper($op['name']);?>"></td>
    <td rowspan="6"><img src="custProfilePic/<?php echo $picName;?>" height="213.33" width="165"/></td>
    </tr>
    <tr>
    <td align="left"><b>Address :</b></td>
    <td align="left"> <textarea rows="3" cols="40" name="address" style="resize:none;" value="<?php echo strtoupper($op['address']);?>"><?php echo strtoupper($op['address']);?></textarea></td>
    </tr>
    <tr>
    <td align="left"><b>Mobile : </b></td>
    <td align="left"><input type="text" name="mobile" value="<?php echo $op['phone'];?>"></td>
    </tr>
        <?php
		if($op['email']=="") $email="Not available";
		else $email=$op['email'];?>
    <tr>
    <td align="left"><b>Email : </b></td>
    <td align="left"><input type="text" name="email" value="<?php echo $email;?>"></td>
    </tr>
    <tr>
    <td align="left"><b>Balance Due 	: </b></td>
    <td align="left"><?php
		echo "<font color=\"#07B603\">&#x20b9;</font> ".number_format((float)$op['balance'], 2, '.', '')."</b><br />";?></td>
    </tr>
    <tr>
    <td align="left"><b>Next Installment on : </b></td>
    <td align="left"><input type="text" name="dob"   id="date" value="<?php echo $op['nextInstallmentDate'];?>" placeholder="Next Installment Date"  required />
      <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
    </tr>
    <tr>
    <td colspan="3" align="center"><br>
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="submit" name="update" value="Update the Information" style="height:30px"></td>
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
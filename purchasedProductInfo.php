<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  require_once("dbcon/dbcon.php");
	  $billDate=date("UYmjHis");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Product Info</title>
<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->
<style>
	
	
</style>

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<!-- ############## image preview ############### -->




<script src="js/jquery.min.js"></script>
<script>
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#img_prev')
.attr('src', e.target.result)
.width(75)
.height(75);
};

reader.readAsDataURL(input.files[0]);
}
}
</script>

<!-- ############## image preview ############### -->
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
</head>

<body style="margin:0px;">


<?php 
$date=date('d-M-Y');
?>



<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>

<form name="pur" action="purchase.php" method="post" enctype="multipart/form-data" onsubmit="return(validate());">

<table width="50%" border="0" cellspacing="2" cellpadding="2" align="center">
  <tr bgcolor="#333333">
    <th colspan="3" scope="row"><font size="+2" color="#FFFFFF">Product Informations</font></th>
  </tr>
    <tr>
    <th colspan="3" scope="row"><font color="#00FF00">
      <?php 
	  $success=$_GET['success'];
	  $invalid_file=$_GET['invalid_file'];
if($success==1)
	{
	echo "<br />The details of purchase has been successfully saved!";
	}
	
?>
    </font><font color="#FF0000">
    <?php 
if($invalid_file==1)
	{
	echo "<br />Invaid File!Please upload as image only.";
	}

?></font>&nbsp;</th>
  </tr>
  <tr>
    <th scope="row" align="left"><font size="3" color="black" face="Rockwell"><b>Date of Purchase :</b></font></th>
    <td align="left" colspan="2"><input type="text" name="dob" value="<?php echo $date;?>"  id="date" placeholder="<?php echo $dateTime;?>"  required />
      <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
  </tr>
  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  
  <tr>
    <th scope="row" align="left"><font size="3" color="black" face="Rockwell"><b>Dealer Name : </b></font></th>
    <?php
	$output=mysqli_query($dbhandle,"Select name From dealer order by name asc");

	$no=mysqli_num_rows($output);
	
	//$fetch=mysqli_fetch_array($output);



?>
    <td align="left" colspan="1" width="40%"><select name="dealer" id="dealer">
      <?php 	
	  	if($no>0)
		{
	?>
      <option label="Select" value="-1" disabled selected>&nbsp;&nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;</option>
      <?php 	
	

	while($op = mysqli_fetch_array($output))
   {
	  ?>
      <option value="<?php echo  strtoupper($op['name']);?>"><?php echo strtoupper($op['name']);?></option>
      <?php 
	}
	}
	else
	{

?>
      <option value="No Dealer" disabled selected><?php echo 'No Dealer';?></option>
      <?php }?>
    </select></td>
    <td><a href="/tranSys2/addDealer.php?return_here=1"
   onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=350,height=450'); return false;">
   <input type="button" name="dealer" value="Add Dealer"/></a></td>
    </tr>
  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th scope="row" align="left"><font size="3" color="black" face="Rockwell"><b>Purchase Invoice  : </b></font></th>
    <td align="left" colspan="2" ><input type="hidden" name="MAX_FILE_SIZE2" value="1000000" />
      <input name="file" type='file' onchange="readURL(this);" placeholder="Browse Bill"/></td>
  </tr>

  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th scope="row" align="left"><font size="3" color="black" face="Rockwell"><b>Total different type of products : </b></font></th>
    <td align="left" colspan="2"><input type="text" name="quantity" id="quantity" required placeholder="Enter total types of Product" ></td>
  </tr>
  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="3" scope="row">&nbsp;</th>
  </tr>
  <tr>
    <th colspan="3" scope="row"><input type="hidden" name="billDate" value="<?php echo $billDate;?>" />      <input type="submit" name="save" value="Next" style="width:100px;height:30px;" /></th>
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
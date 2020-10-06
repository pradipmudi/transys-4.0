<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  if($_GET['return_here']==1 || $_GET['return_here']==2)
	  $return_here=$_GET['return_here'];
	  else
	  $return_here=0;
	  
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Dealer</title>
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
	  function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  
	  
function closeSelf(){
    // do something
 var returnHere="<?php echo $_GET['return_here']?>";
    
	if(returnHere==2){
		window.close();
	}
	
}
  

      </script>
      
<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->
<script type="text/javascript">
function validate()
{
	
	/*if(document.getElementById('name').checked=="")
	{
			  alert("Enter the Dealer Name!!");
			  document.pur.name.focus() ;
			  return false;
	}
	return( true );*/
	
}
</script>
</head>
<body style="margin:0px;" onLoad="closeSelf();">
<?php if($return_here!=1 && $return_here!=2)
		{
?>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<?php }?>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/>
<form name="pur" id="pur" enctype="multipart/form-data" method="post" action="saveDealer.php?return_here=<?php echo $return_here;?>" onsubmit="return(validate());">
<table  border="0" align="center">
  <tr>
    <td colspan="2" align="center"><h3><b>Add Dealer</b></h3></td>
    
  </tr>
 <tr>
    <td align="center" colspan="2"><font color="#00FF00">
<?php
error_reporting(0); 
$success=$_GET['success'];
if($success==1)
	{
	echo "The details of new dealer has been successfully saved!";
	}
?>
</font></td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Name : </b></td>
    <td align="left" colspan="1"><input type="text" name="name" id="name" placeholder="Enter dealer name"  required/></td>
  </tr>
  <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Bank Name :</b> </td>
    <td align="left" colspan="1"><input type="text" placeholder="Enter the Bank name" id="bankName" name="bankName"   /></td>
  </tr>
   <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Account No. :</b> </td>
    <td align="left" colspan="1"><input type="text" placeholder="Enter the account number" id="account" name="account" onkeypress="return isNumberKey2(event)"  /></td>
  </tr>
   <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Phone :</b> </td>
    <td align="left" colspan="1"><input type="text" placeholder="Enter the phone number" id="phone" name="phone" onkeypress="return isNumberKey2(event)" maxlength="10"  /></td>
  </tr>
   <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="left" colspan="1"><b>Address :</b> </td>
    <td align="left" colspan="1"><textarea placeholder="Enter the full address here" id="address" name="address" rows="5" cols="40"   ></textarea></td>
  </tr>
  <tr>
    <td align="center" colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" name="save" value="Save" /></td>
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
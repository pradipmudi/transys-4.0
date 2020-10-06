<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  $existing=$_GET['existing'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Credit Customer</title>
<style type="text/css">
#display_results {color: red; background: #CCCCFF; }
#main {padding: 2px; margin: 100px; margin-left: 200px; width:1000px; color: #FFF;  background-color:#000 width: 520px; }
</style>
<script type="text/javascript "src="ajax.js"></script> 
  <script type='text/javascript'>
   $(document).ready(function(){ 
   $("#search_results").slideUp(); 
   $("#button_find").click(function(event)
   { 
   event.preventDefault();
    search_ajax_way();
	 });
	  $("#search_query").keyup(function(event)
	  {
		   event.preventDefault(); 
		   search_ajax_way(); 
		   }); 
		   });  
		   function search_ajax_way()
		   { 
		   $("#search_results").show();
		     var search_this=$("#search_query").val();
			  $.post("findCreditCustomer.php?existing=<?php if($existing==1) echo "1"; else echo "0";?>", {searchit : search_this}, function(data){ $("#display_results").html(data); 
//http://www.infotuts.com/create-ajax-based-search-system-php-jquery/
//1 of 227-02-2014 15:21

 }) } </script> 
</head>

<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?> 
</td></tr>
</table>
<br/><br/>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->
<table bgcolor="#FFFFFF" id="main" width="40%">
  <tr bgcolor="#000000">
    <td align="center" colspan="2"><h3> Search by the Customer Name or Mobile no. or E-mail or Address <?php if($existing==1) echo "to select the Credit Customer";?>: </h3><br>
<font color="#00FF00">
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
    <td colspan="2" align="center"><form id="searchform" method="post" action="findCreditCustomer.php">
      <label><font color="#000000">Search : </font></label>
      <input type="text" name="search_query" id="search_query" placeholder="Search a customer..................." size="50"/>
      <input type="submit" value="Search" id="button_find" />
    </form></td>
  </tr>
  <tr>
    <td align="center"  id="display_results" colspan="2"></td>
  </tr>
</table>


</body>
</html>


<?php 
}else{
	header('location:index.php');
}
 ?>
 
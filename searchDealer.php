<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head> 
 <title>Search Dealers Here</title>  
 <style type="text/css" > #main { padding: 2px; margin: 100px; margin-left: 200px; width:1000px; color: #FFF;  background-color:#000 width: 520px; } #display_results { color: red; background: #CCCCFF; } </style>
  <script type="text/javascript" src="ajax.js"></script> 
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
			  $.post("findDealer.php", {searchit : search_this}, function(data){ $("#display_results").html(data); 


 }) } </script> 
 </head> 
<body style="margin:0px;">

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?> 
</td></tr>
</table>
<br/>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->



 <table bgcolor="#FFFFFF" id="main">
<tr bgcolor="#000000">
 <td align="center" colspan="2">
 <h3> Search the Dealer by Name,Mobile,Address,Account No. : </h3>  </td></tr>
 <tr>
 <td colspan="2" align="center">
 <form id="searchform" method="post" action="find.php"> 
 <label><font color="#000000">Search : </font></label><input type="text" name="search_query" id="search_query" placeholder="Whom do u want to search?" size="50"/>  <input type="submit" value="Search" id="button_find" /> </form>
 </td></tr>
<tr><td align="center"  id="display_results" colspan="2">
  </td>
  </tr>
 </table> 
 <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add footer here !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->


   
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! add footer here !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
 
 
</body> 
</html>

<?php 
}else{
	header('location:index.php');
}
 ?>
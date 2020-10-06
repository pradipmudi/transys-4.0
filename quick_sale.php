<?php
ob_start();
session_start();
if($_SESSION['type']!='super')
  {
  	header('location:index.php');
  }
  else
  {
  	  error_reporting(0);
	  require_once("dbcon/dbcon.php");  
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
function confirmInput(){
	var sl = (document.getElementById("sl").value);
	if(sl.toUpperCase()=="CASH")
		alert("EXIT")
	else{
		var table = document.getElementById("myTable");
	    var row = table.insertRow(0);
	    var cell1 = row.insertCell($sn);
	    var cell2 = row.insertCell($sl.toUpperCase());
	    var cell2 = row.insertCell(2);
	    var cell2 = row.insertCell(3);
	    var cell2 = row.insertCell(4);
		}
	
}
</script>
	<style>
table, th, td {
    
}
</style>
</head>
<body >

<table border = "1">
  <col width="1300" >
  <tr>
    <th height = "700" align="left" valign="top">
		
		


		<br><br>&nbsp;&nbsp;<form onsubmit="confirmInput()" action="">
Enter Data: <input id="sl" type="text" size="20" autofocus ></form><br><br><br>
		<table id="inv_tab" >
		  <col width="1300" >
		  <tr>
		    <th valign="top" width="100%" height = "500" >
				<table valign="top" cellspacing = "4">
					<tr>
						<col width = "10" >
						<td bgcolor="#ffcc33"  width = "10">SL</td>
						<td bgcolor="#ffcc33" width = "600">Description</td>
						<td bgcolor="#ffcc33" >Qnty</td>
						<td bgcolor="#ffcc33" width = "300">Rate</td>
						<td bgcolor="#ffcc33" width = "300">Total</td>

					</tr>
					<tr>
					<td>
					<span id="id1">&nbsp;</span>
					</td>
					</tr>
				</table>



		    </th>
		  </tr>
		  
		</table>


    </th>
  </tr>
  
</table>
</body>
</html>
<?php 
}
 ?>
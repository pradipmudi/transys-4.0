<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>


<?php
ob_start();
session_start();

if(isset($_SESSION['user']))
  {
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
?>

<style>
div#p {
	position: absolute;
    background-color: lightgrey;
    width: 800px;
    
    top: 10%;
    left: 20%;
    border: 5px solid green;
    padding: 10px;
    margin: 50px;
}
</style>
<style type="text/css">
#abc {
width:100%;
height:100%;
opacity:.95;
top:0;
left:0;
display:none;
position:fixed;
background-color:#4c2e2e;
overflow:auto
}
img#close {
position:absolute;
right:-14px;
top:-14px;
cursor:pointer
}
div#popupContact {
position:absolute;
left:25%;
top:17%;
margin-left:-202px;
font-family:'Raleway',sans-serif
}
form {
max-width:1000px;
min-width:250px;
padding:25px 50px;
border:2px solid gray;
border-radius:10px;
font-family:raleway;
background-color:#fff
}
p {
margin-top:30px
}
h2 {
background-color:#FEFFED;
padding:20px 35px;
margin:-10px -50px;
text-align:center;
border-radius:10px 10px 0 0
}
hr {
margin:10px -50px;
border:0;
border-top:1px solid #00ff65;
}
input[type=textt] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}

input[type=qnty] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}
input[type=cc] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}
input[type=pcc] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}
input[type=cata] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}
input[type=prc] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}
input[type=sl] {
width:99%;
padding:10px;
margin-top:30px;
border:1px solid #003524;
padding-left:5px;
font-size:16px;
font-family:raleway
}

textarea {
background-image:url(../images/msg.png);
background-repeat:no-repeat;
background-position:5px 7px;
width:82%;
height:95px;
padding:10px;
resize:none;
margin-top:30px;
border:1px solid #ccc;
padding-left:40px;
font-size:16px;
font-family:raleway;
margin-bottom:30px
}
#submit {
text-decoration:none;
width:100%;
text-align:center;
display:block;
background-color:#FFBC00;
color:#fff;
border:1px solid #FFCB00;
padding:10px 0;
font-size:20px;
cursor:pointer;
border-radius:5px
}
span {
color:red;
font-weight:700
}
button {
width:10%;
height:45px;
border-radius:3px;
background-color:#cd853f;
color:#fff;
font-family:'Raleway',sans-serif;
font-size:18px;
cursor:pointer
}

</style>
<script type="text/javascript">
		function set(){
		
		document.getElementById("data").innerHTML = "";
		var n=document.getElementById("colno").value;var a = "";
		a='<table><tr border = "1px">	<td width="400" >Product Name</td>	<td width="100" >Serial Number</td>	<td width="100" >Vat</td>	<td width="100" >Quantity</td>	<td width="100" >Rate</td>	<td width="100" >Price</td></tr>';
		for (var i = 0;i<parseInt(n);i++) {			
			a= a.concat('	<td>&nbsp;<input type="textt" name="productNamesForInvoice[]"  placeholder="Enter product name"  id = "p' + i + "" + '"></td>	<td>&nbsp;<input type="sl" name="serialNos[]" id = "sl' + i + "" + '"></td>	<td>&nbsp;<input type="cata" name="vats[]" id = "cat' + i + "" + '" ></td>	<td>&nbsp;<input type="qnty" value = "1" name="" id = "qt' + i + "" + '"></td>	<td>&nbsp;<input type="prc" onkeyup="mull(this.id);"  name="" id = "prc' + i + "" + '"></td>	<td>&nbsp;<input type="pcc" name="" disabled="true" id="tot_prc' + i + "" + '"></td></tr>				');
		}
		a=a.concat('  </table>');
		document.getElementById("data").innerHTML = a;
		return true;
	}
	function div_show() {
	set();
document.getElementById('abc').style.display = "block";
}
function mull(id){
		var a = id;
		a=parseInt(a.substring(3));
		var qt = parseInt(document.getElementById("qt"+a).value);
		var val = parseInt(document.getElementById(id).value);
		document.getElementById("tot_prc" + a).value =  qt*val;
	}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}

</script>
</head>
<body>

 <?php include("header.php"); ?>

<div id = "p">
<?php if($_POST["save_status"]==1)
	echo '<p style="font-family:courier;color:red">Data Will be Saved..</p>';
	else
		echo '<p style="font-family:courier;color:red">Data Will be LOST..</p>';
?>
<form method="post" action="#">
	Invoice Date : <input type="date" id="datepicker" name=""><br><br>
	Invoice Number : <input type="" name=""><br><br>
	Buyer Name : <input type="" name=""><br><br>
	Buyer Email : <input type="" name=""><br><br>
	Buyer Address :<br> <textarea></textarea><br><br>
	Buyer Contact Number : <input type="" name=""><br><br>
	Distrinct Product: <input type="" name="" id="colno"><br><br>
	<input type="submit" onclick="div_show(); return false;" name="">

</form>



</div>
<div id="abc">
<div id="popupContact">
<!-- Contact Us Form -->

<form action="#" id="form" method="post" name="form">
<img id="close" src="3.png" onclick ="div_hide()">
<h2>Enter Product Information</h2>

<hr>
<div id = "data"></div>


<hr>
<a href="javascript:%20check_empty()" id="submit">Submit</a>
</form>
</div>
<!-- Popup Div Ends Here -->
</div>

<?php 
}else{
	header('location:index.php');
}
 ?>

</body>
</html>


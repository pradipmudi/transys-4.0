<link rel="stylesheet" href="styles/navi.css" type="text/css" />
<style type="text/css">
.style {color: #00ffff; font-weight: bold; }
</style>
<link rel="stylesheet" href="css/style.css" type="text/css" />
	<!-- Mootools CORE -->
	<script type="text/javascript" src="js/mootools-release-1.11.js"></script>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#BBBBBB">
<tr>
<td bgcolor="black" width="100%">
<font color="#FFFFFF">
<center><?php echo "Header Here" ;?></center>
</font></td>
</tr>
<tr>
<td align="right" width="100%" height="100%">
<div style="width: 1360px; height:0px;" align="left">
  <div id="topnav">
	<ul id="nav">
	  <!-- <li><a class="active" style="text-decoration:none;" href="adm_home.php" title="Home">Home</a></li> -->
	  
	  <li><a class="active" href="#home">Home</a></li>
      <li><a class="active" style="text-decoration:none;" href="logout.php" title="Log Out">Log Out</a></li>
	</ul>
  </div>
</div>

<?php 
	date_default_timezone_set("Asia/Kolkata");
	$todayDate=date('d M Y');
	$todayTime=date('  h:i:s A');
	echo "Date : <b>".$todayDate."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />Time : <b>".$todayTime."</b>&nbsp;&nbsp;&nbsp;&nbsp;";
?>

</td>
</tr>
</table>

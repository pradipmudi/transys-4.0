<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {

require_once("dbcon/dbcon.php");

$bill=$_GET['bill'];

$sql=mysqli_query($dbhandle,"Select * From purchase where id='$bill'");

$w=mysqli_num_rows($sql);

$fetch=mysqli_fetch_array($sql);

 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Purchase Bill</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
  <?php //echo "Select * From purchase where serialno='$bill'";?>
    <td><img src="<?php echo "uploads/".$fetch['bill']; ?>" width="100%" height="100%"/></td>
  </tr>
</table>

</body>
</html>
<?php 
}
else
{
	header('location:index.php');
}
 ?>
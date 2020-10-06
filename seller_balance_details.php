
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Listing</title>
	</head>
	<body>
				<?php
					require_once("./dbcon/dbcon.php");
					//error_reporting(0);
					$sql1 = "SELECT * FROM  payment  WHERE DATE(date) = DATE_SUB(CURDATE(), INTERVAL 7 DAY) ";  
					$query1=mysqli_query($dbhandle,$sql1);
					$total_sale=0;
					$toatl_tax=0;
					while ($op=mysqli_fetch_array($query1)) {
						$total_sale+=$op['price'];
						$toatl_tax+=$op['govt_tax'];
					}
					$available_balance=$total_sale-$toatl_tax;
					$amazon_fees=$total_sale/100;
					$sql2=" SELECT sum(price) as totalPrice FROM payment  WHERE date = DATEADD(day,-7, GETDATE())";
					$query2=mysqli_query($dbhandle,$sql2);
					$fetch=mysqli_fetch_array($query2);
					$unavailable_balance=$fetch['totalPrice'];
				?>
		<table>
			<tr>
				<td>Total Sale : </td>
				<td><?php echo $total_sale; ?></td>
			</tr>
			<tr>
				<td>Tax : </td>
				<td><?php echo $toatl_tax;?></td>
			</tr>
			<tr>
				<td>Available Balance : </td>
				<td><?php echo $available_balance; ?></td>
			</tr>
			<tr>
				<td>Amazon Fees : </td>
				<td><?php echo $amazon_fees; ?></td>
			</tr>
			<tr>
				<td>Fees yet to receive<br>(Unavailable Balance) : </td>
				<td><?php echo $unavailable_balance; ?></td>
			</tr>
		</table>
	</body>
</html>
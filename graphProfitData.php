<?php
	$profitMultiyear=$_POST['profitMultiyear'];
	$profitSingleyear=$_POST['profitSingleyear'];
	$profitMonth=$_POST['profitMonth'];
	$profitDate=$_POST['dateProfit'];
	$dateOfPreviousEntry=$profitDate;
	$explodeProfitDate=explode("-",$profitDate);
	$profitMonthYearName=$explodeProfitDate[0]."-".$explodeProfitDate[0];
	$profitYearName=$explodeProfitDate[0];
	$todayProfitMonthYear=date('Y-m'); //  to be entered/updated in the profitSingleYear table
	$todayProfitYear=date('Y'); //  to be entered/updated in the profitMultiYear table
if($date==$dateOfPreviousEntry)
	{
		$currentMultiyearProfit=$profitMultiyear+$totalProfit;
		$currentSingleyearProfit=$profitSingleyear+$totalProfit;
		$currentMonthProfit=$profitMonth+$totalProfit;
		
		$sql14="UPDATE `profitsingleyear` SET `profit` = '$currentSingleyearProfit' WHERE `profitsingleyear`.`session` = '$profitMonthYearName'";
		$query14=mysqli_query( $dbhandle,$sql14);
		
		$sql15="UPDATE `profitmultiyear` SET `profit` = '$currentMultiyearProfit' WHERE `profitmultiyear`.`session` = '$profitYearName'";
		$query15=mysqli_query( $dbhandle,$sql15);
		
		$sql16="UPDATE `profitmonth` SET `profit` = '$currentMonthProfit' WHERE `profitmonth`.`session` = '$profitYearName'";
		$query16=mysqli_query( $dbhandle,$sql16);
		
	}
else
	{
		echo "Profit=".$totalProfit;
		$sql14="INSERT INTO profitmultiyear "."VALUES('$todayProfitYear','$totalProfit')";
		$query14=mysqli_query( $dbhandle,$sql14);
		
		$sql15="INSERT INTO profitsingleyear "."VALUES('$todayProfitMonthYear','$totalProfit')";
		$query15=mysqli_query( $dbhandle,$sql15);
		
		$sql16="INSERT INTO profitmonth "."VALUES('$date','$totalProfit')";
		$query16=mysqli_query( $dbhandle,$sql16);
	}
	

?>
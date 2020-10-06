<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  require_once("dbcon/dbcon.php");
	  require_once("fusioncharts/fusioncharts.php");
	  $chartBy=$_GET['type'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Profit Chart of <?php echo strtoupper($chartBy);?></title>
      <!-- FusionCharts Core Package File -->
      <script src="fusioncharts/js/fusioncharts.js"></script> 
      <script type="text/javascript" src="fusioncharts/js/elegant.js"></script>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
      
  </head>
  
<?php
 	  
 	  if($chartBy=='week')
	  {
		  $tableName="profitmonth";
		  $limit=" limit 7";
		  $period="Week";
	  }
	  else if($chartBy=='month')
	  {
		  $tableName="profitsingleyear";
		  $limit=" limit 12";
		  $period="Month";
	  }
	  else if($chartBy=='year')
	  {
		  $tableName="profitmultiyear";
		  $period="Year";
	  }

$sql="select max(profit)highestProfit from $tableName";
$query=mysqli_query($dbhandle,$sql);
while($op=mysqli_fetch_array($query))
{
	$highestProfit=$op['highestProfit']+$op['highestProfit']/2;
}
//SQL Query for the Parent chart.
$strQuery = "SELECT period, profit FROM $tableName order by period desc $limit";

//Execute the query, or else return the error message.
$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

//If the query returns a valid response, preparing the JSON array.
if ($result) {
    //`$arrData` holds the Chart Options and Data.
    $arrData = array(
        "chart" => array(
            "caption" => "TranSys Profit Chart",
            "xAxisName"=> "$period",
            "yAxisName"=> "Profit",
            "paletteColors"=> "#1FD6D1",
            "yAxisMaxValue"=> "$highestProfit",
            "baseFont"=> "Open Sans",
            "theme" => "elegant"
            
        )
    );
    
    //Create an array for Parent Chart.
    $arrData["data"] = array();
    
    // Push data in array.
    while ($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["period"],
            "value" => $row["profit"],
            "link" => "newchart-json-" . $row["period"]
        ));
        
    }
    
    //Data for Linked Chart will start from here, SQL query from quarterly_sales table 
    $year = $row["period"];
    $strQuarterly = "SELECT profit, period FROM $tableName WHERE 1";
    $resultQuarterly = $dbhandle->query($strQuarterly) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
    
    //If the query returns a valid response, preparing the JSON array.
        if ($resultQuarterly) {
        $arrData["linkeddata"] = array(); //"linkeddata" is responsible for feeding data and chart options to child charts.
        $i = 0;
        if ($resultQuarterly) {
            while ($row = mysqli_fetch_array($resultQuarterly)) {
                $year = $row['period'];
                if (isset($arrData["linkeddata"][$i-1]) && $arrData["linkeddata"][$i-1]["id"] == $year) {
                    array_push($arrData["linkeddata"][$i-1]["linkedchart"]["data"], array(
                        "label" => $row["period"],
                        "value" => $row["profit"]
                    ));
                } 
                /*else 
                {
                    array_push($arrData["linkeddata"], array(
                        "id" => "$year",
                        "linkedchart" => array(
                            "chart" => array(
                                "caption" => "QoQ profit - KFC for $year",
                                "xAxisName"=> "Period",
                                "yAxisName"=> "Profit",
                                "paletteColors"=> "#D5555C",
                                "baseFont"=> "Open Sans",
                                "theme" => "elegant"
                            ),
                            "data" => array(
                                array(
                                    "label" => $row["period"],
                                    "value" => $row["profit"]
                                )
                            )
                        )
                    ));

                    $i++;
                }*/
            }
        }
        
            
        $jsonEncodedData = json_encode($arrData, JSON_PRETTY_PRINT);
        
        $columnChart = new FusionCharts("column2d", "myFirstChart" , "100%", "500", "linked-chart", "json", "$jsonEncodedData"); 
        
        $columnChart->render();    //Render Method
             
        $dbhandle->close(); //Closing DB Connection
     
    }
}
?> 

    <body style="margin:0px auto;" >
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table><br>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////-->
     <!-- DOM element for Chart -->
     <?php echo "<script type=\"text/javascript\" >
			   FusionCharts.ready(function () {
			FusionCharts('myFirstChart').configureLink({     
			overlayButton: {            
			message: 'Back',
			padding: '13',
			fontSize: '16',
			fontColor: '#F7F3E7',
			bold: '0',
			bgColor: '#22252A',           
			borderColor: '#D5555C'         }     });
			 });
			</script>" 
?>
         <center>
           <div id="linked-chart">Profit Chart by <?php echo strtoupper($chartBy);?></div></center>
</body>
</html>
<?php 
}else{
	header('location:index.php');
}
 ?>
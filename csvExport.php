<?php
//session_start();
ob_start();
session_start();
error_reporting(0);
if(isset($_POST['tableName'])) 

{
require_once("dbcon/dbcon.php");
date_default_timezone_set("Asia/Kolkata");
$dateTime=date('D d-M-Y H:i:s');
$tableName = $_POST['tableName'];
$fileName=$tableName." ".$dateTime;
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=".$fileName.".xls" );



// If data send via POST, with the name "cbname"

       // gets the value of the selected checkboxes
 

 $sql="select * from ".$tableName." order by entryDate desc";
//echo $sql;


$result = mysqli_query($dbhandle,$sql);
echo '<table border=\"1\">';

$cnt = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if ($cnt == 0) {
        $columns = array_keys($row);

        echo '<tr><th>' . implode('</th><th>', $columns) . '</th></tr>'; // creating columns for each field in a row
    }

    $cnt++;
    echo '<tr>';

    foreach ($row as $name => $value) {
        if ( $value == "" ) $value="&nbsp;&nbsp;";
        echo '<td> <font color=\"#000000\">'.$value.'</font> </td>'; 
    }

    echo '</tr>'; 
}

echo "</table>";











}




else
 {
  echo 'An error is occured please try again';
}


?>
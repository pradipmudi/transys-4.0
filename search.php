<?php
require_once("dbcon/dbcon.php");
//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysqli_query ($dbhandle,"SELECT productName, serialNo FROM serialno WHERE productName LIKE '%{$query}%' OR serialNo LIKE '%{$query}%'");
	$array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['productName'].', '.$row['serialNo'],
            'value' => $row['productName'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>
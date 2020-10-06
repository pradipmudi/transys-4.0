<?php
	 $username = "root";
	 $password = "";
	 $hostname = "localhost";
	  
	 $db='transys'; // database name
	 
	//connection to the database
$dbhandle=mysqli_connect($hostname,$username,$password,$db);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


mysqli_select_db($dbhandle,$db);



?>
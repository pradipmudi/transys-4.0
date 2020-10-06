<?php
 session_start();
 
 session_unset();
 $_SESSION['user']=0;
 session_destroy();
 header('location: index.php');
 ?>
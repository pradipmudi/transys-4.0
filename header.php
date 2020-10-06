<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function constr(){
	alert("This side is under construction..")
}	


</script>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
}

li {
    float: left;
}

li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #52143d;
    color:#e7e7e7;

}

li a.active {
    color: white;
    background-color: #4CAF50;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" style="text-decoration:none;" href="admHome.php" title="Purchase">Home</a></li>
  <li><a href="#news" onclick="constr()">News</a></li>
  <li><a href="#contact" onclick="constr()">Contact</a></li>
  <li><a href="#about" onclick="constr()">About</a></li>
  <li style="float:right"><a class="logout" href="logout.php">Logout</a></li>
</ul>

</body>
</html>

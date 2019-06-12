<?php
session_start();
if($_SESSION["authuser"]!=1){
	header("Location:main.php");
	
}
$servername = "localhost";
$username = "root";
$password = "";
$db_database='novostack';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_POST['delete']))
						{
                        $emp_uname =$_POST['name'];
						$sql = "DELETE FROM employee1 WHERE uname='$emp_uname'";
                        $conn->exec($sql);
                        Redirect('home.php');
						}
	}
	catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
function Redirect($url) { 
       if(headers_sent()) { 
               echo "<script type='text/javascript'>location.href='$url';</script>"; 
       } else { 
               header("Location: $url"); 
       } 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Enter Uname</title>
<style>
.header{
		height:100px;
		background:#99F58B;
		text-align:center;
	}
	body{
		background:#C7E59D;
	}
</style>
</head>
<body>
<div class="header">
	<h1><font size="40"> Novostack</font></h1>
</div>
<br><br><br>
<form action="delete.php" method="post">
<pre>
											User Name:  <input type="text" name="name">
<br>

														<input type="submit" name="delete" value="Delete">
</form>
</body>
<html>
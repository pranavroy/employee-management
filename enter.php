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
	if(isset($_POST['submit']))
						{
                        $emp_name = $_POST['name'];
                        $emp_age = $_POST['age'];
						$emp_uname = $_POST['uname'];
						$emp_pword = md5($_POST['pword']);
						$sql = "INSERT INTO employee1 (name, age, uname, pword) VALUES ('$emp_name','$emp_age','$emp_uname','$emp_pword')";
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
<title>Enter Here</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
<div class="container">
<form action="enter.php" method="post">
                             <div class="form-group">

                               Name:           <input type="text" class="form-control" name="name"></div>
<br>
         <div class="form-group">                       Age:            <input type="text" class="form-control" name="age"></div>
<br>
         <div class="form-group">                      User Name:      <input type="text" class="form-control" name="uname"></div>
<br>
        <div class="form-group">                       Password:       <input type="password" class="form-control" name="pword"></div>
<br>

                           <input type="submit" class="btn btn-default" name="submit" value="Submit"></div>
</form>
</body>
<html>
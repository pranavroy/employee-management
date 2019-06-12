<?php
session_start();
$_SESSION["authuser"]=0;

$servername = "localhost";
$username = "root";
$password = "";
$db_database='novostack';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_POST['submit']))
						{
							$uname=$_POST['name'];
							$pword=md5($_POST['pass']);
							
							if($uname==""){ $error="<br><span class=error>Please enter a username</span><br><br>"; }
							elseif($pword==""){ $error="<br><span class=error>Please enter the password</span><br><br>"; }
							else
							{
								$stmt = $conn->prepare("SELECT uname, pword FROM employee1 WHERE (uname=:uname) and (pword=:pword)"); 
                                
								$stmt-> bindParam(':uname', $uname);
								$stmt-> bindParam(':pword', $pword);
								$stmt-> execute();
								$results=$stmt->fetchAll(PDO::FETCH_OBJ);
								 if($stmt->rowCount() > 0)
									{
									Redirect('home.php'); 
									$_SESSION["uname"]=$uname;
									$_SESSION["authuser"]=1;
									
									} else{
										echo "<script>alert('Invalid Details');</script>";
										}
							}
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
<title>USER LOGIN</title>
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
                     <form action="main.php" method="post">
                     <div class="form-group">
                         Username:            <input type="text" class="form-control" name="name"></div>
                         <br>
                     <div class="form-group">
                         Password:            <input type="password" class="form-control" name="pass"></div>
                         <br><br>
                         <input type="submit" class="btn btn-default" name="submit" value="login">
                     </form>
</div>
</body>
<html>
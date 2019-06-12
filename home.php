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
if(isset($_POST['add']))
						{	Redirect('enter.php'); 

						}
if(isset($_POST['delete']))
						{	Redirect('delete.php'); 

						}	
if(isset($_POST['logout']))
						{	
					session_unset();
					  Redirect('main.php'); 

						}							
?>
<!DOCTYPE html>
<html>
<head>
<title>USER LOGIN</title>
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
	.button1
	{
		background:#FFE4B5	;
		border:1px;
		font-size:30px;
		border-radius:8px;
		border-color:black;
		float:left;
	}
	.button2
	{
		background:#FFE4B5	;
		border:1px;
		font-size:30px;
		border-radius:8px;
		border-color:black;
		float:right;
	}
	.button3
	{
		background:#FFE4B5	;
		border:1px;
		font-size:30px;
		border-radius:8px;
		border-color:black;
		float:right;
	}
</style>
</head>
<body>
<div class="header">
	<h1><font size="40"> Novostack</font></h1>
</div>
<h2>Employee Records</h2>
                        <div class="table-responsive">
                    	<table class="table" cellpadding="0" cellspacing="0" border="1px" width="1500px">
							<tr>
                                <td><b>Name</b></td>
                                <td><b>Age</b></td>
                                <td><b>Uname</b></td>
                            </tr>
							 <?php
							 class TableRows extends RecursiveIteratorIterator { 
								function __construct($it) { 
									parent::__construct($it, self::LEAVES_ONLY); 
								}

								function current() {
									return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
								}

								function beginChildren() { 
									echo "<tr>"; 
								} 

								function endChildren() { 
									echo "</tr>" . "\n";
								} 
							    } 
								try {
								 $stmt = $conn->prepare("SELECT name, age, uname FROM employee1"); 
								$stmt->execute();
								$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
								foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
								echo $v;}
								}catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
								}
							?>                       
                        </table>
						</div>
					<br>
					<br>
<form action="enter.php" method="">
<input type="submit" class ="button1" name="add" value="add">
</form>
<form action="delete.php" method="">
<input type="submit"class="button2" name="delete" value="Delete">	</form>	
<form action="main.php" method="">
<input type="submit"class="button3" name="logout" value="Logout">	</form>			
</body>
<html>
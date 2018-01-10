<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Login/Sign Up!</title>
<link rel="stylesheet" type="text/css" href="css/login_style.css">
</head>
<body>
<div class="container">
	
<header>
	<img src="img/images.png">
	<a href="signup.php"></a>
</header>
<div class="sec1">
<form action="#" method="post" >
	<h4>UserName</h4>
	<input type="text" name="username">
	<br>
	<h4>Password</h4>
	<input type="password" name="password">
	<br>
	<input type="submit" name="submit" value="Login">
	<br>
	<button class="sign"><a href="cust_form.php">Sign Up</a></button>
	</form>
</div>
</div>
<?php

include 'dbcon.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
$user = $_POST['username'];
$_SESSION['login_user']= $user;  // Initializing Session with value of PHP Variable
//echo $_SESSION['login_user'];

$password = $_POST['password'];
$sql = "SELECT * FROM Customer WHERE username ='$user' AND password = '$password';";
$result = mysqli_query($conn, $sql);
if($result){

	$row = mysqli_fetch_array($result);
	print_r($row);

	if (!empty($row)) {
		echo $row['role'];
		

		echo "You have logged in!";
		if ($_SESSION['login_user']) {
			header("location:cust_view.php");
		}
	}
	else{
	echo "Login Failed";
	}
}
}

mysql_close($conn);
?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Details</title>
	<link rel="stylesheet" type="text/css" href="css/custform_style.css">

</head>
<body>


<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

?>

	<?php

		 function test($data) {
		
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		
		}

	include 'dbcon.php';

	
	if(!empty($_GET['id'])){
	$id = $_GET['id'];
	$sql = "SELECT * from Customer where id=".$id;
	$query = mysqli_query($conn, $sql);
	$res = mysqli_fetch_array($query);
	//print_r($res);exit;
	}


	$nameErr = $usernameErr = $emailErr = $passErr = $addErr = $genderErr = $phoneErr = "";
	$name = $username = $email = $password = $gender = $phone = $city = $state = $address = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// echo '<pre>'; print_r($_POST); echo '</pre>';

	//name check
	 	if (empty($_POST["name"])) {
	 		
    		$nameErr = "Name is required";
    		
  		} 
		else{ 
			
			
			$name = test($_POST['name']);
		
				if(ctype_alpha($name) === false){
  					$nameErr = 'Name must contain letters and spaces only';
			}
		}
		//Userename check
		if (empty($_POST["username"])) {
		    		$usernameErr = "Username is required";
		  		}
		else{
				$username = test($_POST['username']);
			if(!preg_match("/^\w{5,}$/", $username)) { // \w equals "[0-9A-Za-z_]"
	    	// valid username, alphanumeric & longer than or equals 5 chars
	    		$usernameErr = "Enter a valid username less than 5char.";
			}	
		}  		
		//email check
		if (empty($_POST["email"])) {
		    $emailErr = "Email is required";
		 }

	  	else{ 
				$email =test($_POST['email']);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			      $emailErr = "Invalid email format"; 
		    	}
		}
		//password check
		if (empty($_POST["password"])) {
    		$passErr = "Password is required";
  		}
		else{ 
			$password = test($_POST['password']);
		}
		//gender check
		if(empty($_POST['gender'])){
			$genderErr = "Gender is required";
		}
		else{
			$gender = test($_POST['gender']);
		}
		//address check
		if(empty($_POST['address'])){
			$addErr = "Address is required";
		}
		else{
			$address = test($_POST['address']);
		}
		//phone check
		if(empty($_POST['phone'])){
			$phoneErr = "Phone number is required";
		}
		else{
			$phone = test($_POST['phone']);
		}
		$city = test($_POST['city']);
		$state = test($_POST['state']);

		$sql = "INSERT INTO Customer (name,username,password,email,gender,address,phone_no,city,state)
		VALUES ('$name','$username','$password','$email', '$gender','$address','$phone','$city','$state');";
		//echo $sql;

		if (mysqli_query($conn, $sql)) {

				
				    echo "New record created successfully";
				    header("location:cust_view.php");
			} 
			else {
				    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}

}

	?>

		<div class="conteiner">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			 <p><span class="error">* required field.</span></p>
			 <p>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?php if(!empty($_GET['id'])){
        	echo $res['name'];
        	}else{echo $name; }?>"/>
        <span  class="error">*<?php echo $nameErr?></span>
    </p>
			 <p>
        <label for="uname">UserName</label>
        <input id="username" type="text" name="username" value="<?php if(!empty($_GET['id'])){
        	echo $res['username'];
        	}else{echo $username; }?>" />
        <span  class="error">*<?php echo $usernameErr?></span>

    </p>
			 <p>
        <label for="pass`">Password</label>
        <input id="password" type="password" name="password"/>

    </p>
			 
				 <p>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php if(!empty($_GET['id'])){
        	echo $res['email'];
        	}else{echo $email; }?>"/>
        <span  class="error">*<?php echo $emailErr?></span>

    </p>

    		 <p>
        <label for="gender">Gender</label>
        <input type="radio" name="gender"  value="male" />Male
        <input  type="radio" name="gender"  value="female" />Female
        <span  class="error">*<?php echo $genderErr; ?></span>


    </p>
		 <p>
        <label for="add">Address</label>
        <input id="address" type="text" name="address"value="<?php if(!empty($_GET['id'])){
        	echo $res['address'];
        	}else{echo $address; }?>"/>
        <span  class="error">*<?php echo $addErr; ?></span>

    </p>	
			 <p>
        <label for="name">Phone No</label>
        <input id="phone" type="tel" name="phone" value="<?php if(!empty($_GET['id'])){
        	echo $res['phone_no'];
        	}else{echo $phone; }?>"/>
        <span  class="error">*<?php echo $phoneErr?></span>

    </p>
		
			 
 	<p>
        <label for="city">City</label>
        <input id="city" type="text" name="city" value="<?php if(!empty($_GET['id'])){
        	echo $res['city'];
        	}else{echo $city; }?>" />
        
    </p>
		 <p>
        <label for="state">State</label>
        <input id="state" type="text" name="state" value="<?php if(!empty($_GET['id'])){
        	echo $res['state'];
        	}else{echo $state; }?>" />
        

    </p>
			
			<p class="submit">
        <input type="submit" value="Submit" />
    </p>

		</form>
	</div>
</body>
</html>	


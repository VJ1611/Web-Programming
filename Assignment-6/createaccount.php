

<?php

$nameErr = $passMatch = $passErr = $success = "";


function testFields(){
	global $nameErr , $passMatch , $passErr;
	$toggle=true;
	if(empty($_POST['uname'])){
		$toggle=false;
		$nameErr="Please   a user name";
	}
	if(empty($_POST['password'])){
		$toggle=false;
		$passErr="Please provide a password";
	}
	if(empty($_POST['retype'])||!($_POST['password']===$_POST['retype'])){
		$toggle=false;
		$passMatch="Passwords must match";
	}
	return $toggle;
}
 
if(!empty($_POST['create'])){
	
	
		if(testFields()){
			$con=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");
			// Check connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			// escape variables for security
			$username = mysqli_real_escape_string($con, $_POST['uname']);	
			$passwd = mysqli_real_escape_string($con, $_POST['password']);

			//$passwd=crypt($passwd);
			$query="Select * FROM logintable WHERE Username='$username'";
			
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_array($result);
			if(!mysqli_num_rows($result)){
				//$passwd=crypt($passwd, '$6$rounds=5000$letslockthisdown$');

				$sql="INSERT INTO logintable (Username, Password)
					VALUES ('$username', '$passwd')";

					if (!mysqli_query($con,$sql)) {
						die('Error: ' . mysqli_error($con));
					}
				$success= "user '$username' successfully added, please log in";

				mysqli_close($con);		
				
				header ("Location: http://codd.cs.gsu.edu/~vjavvaji1/login.php");
			
			
			}else{
				$success="User already exists, please log in by clicking the browser previous button or try a different username";
			}
		}
		
	}



?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div id="title">
<h2>Create a new account </h2></br>

</div>
Please provide details to create an Account:
<form name="createaccount" action="createaccount.php" method="post">
Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="uname"></input>*<?php echo $nameErr; ?></br>
Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;<input type="password" name="password"></input>*<?php echo $passErr; ?></br>
Retype Password: &nbsp;&nbsp;&nbsp; &nbsp;<input type="password" name="retype"></input>*<?php echo $passMatch; ?></br>
<div id="req">* is required</div>
<div id="input">
<input type="Submit" name="create" value="Create Account"></input>
</div>

</form>
<h2><?php echo $success ?></h2>
</body>
</html>
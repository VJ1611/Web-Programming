

<?php

$nameErr = $passMatch = $passErr = $success = "";
$loggedIn=false;
$cookieN="login";
$cookieV="yes";

if(isset($_COOKIE[$cookieN])){
	session_start();
	$_SESSION['login']=$_COOKIE[$cookieN];
}

function testFields(){
	global $nameErr , $passMatch , $passErr;
	$toggle=true;
	if(empty($_POST['uname'])){
		$toggle=false;
		$nameErr="Please enter the user name";
	}
	if(empty($_POST['password'])){
		$toggle=false;
		$passErr="Please enter the password";
	}
	
	return $toggle;
}
 
if(!empty($_POST['submit'])) {
	
		if(testFields()){
			$con=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");

			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$username = mysqli_real_escape_string($con, $_POST['uname']);
			$passwd = mysqli_real_escape_string($con, $_POST['password']);
		
			$query="Select * FROM logintable WHERE Username='$username'";
			
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_array($result);
			if(mysqli_num_rows($result)){
				
				
				$hash=$row['Password'];
				//$hash2=crypt($passwd,$hash);
			//	if($hash==$hash2)
				if($hash==$passwd)
				{
					session_start();
					$_SESSION['login']="huh";
					header ("Location:  http://codd.cs.gsu.edu/~vjavvaji1/album.php");
				}else{
					$success="Incorrect Password, Please Try Again";
				}
			}else{
				$success="User does not exist, Please Try Again or create an account";
			}
			
			mysqli_close($con);	
		}
	
}
if(!empty($_POST['newsubmit']))
{
	header ("Location: http://codd.cs.gsu.edu/~vjavvaji1/createaccount.php");
}


if (!empty($_SESSION['login'])) {

	header ("Location: http://codd.cs.gsu.edu/~vjavvaji1/album.php");

}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div id="title">
<h1>Album Database</h1>

</div>

<div id ="title">
Please Log in or Create an Account:<br>
*required field<br>


<form name="login" action="login.php" method="post">

Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="uname"></input>*<?php echo $nameErr; ?></br>
Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="password"></input>*<?php echo $passErr; ?></br>


<div id="input">
<input type="Submit" name="submit" value="Log In" text="Log In"></input>
<input type="Submit" name="newsubmit" value="Create Account"></input>
</div>

</form>
<br>
</div>
<h2><?php echo $success ?></h2>
</body>
</html>
<?php 
  include 'db.php';
  include "config.php";

  	header("Cache-Control: no-cache, no-store", true);
  	error_reporting(0);
	session_start();
/***************deleteAcount */
	if (isset($_SESSION['owner_id'])) {
		if(isset($_GET["deleteaccount"])){
			$query_delete="DELETE FROM tbl_ownerdog_207 WHERE owner_id=" . $_SESSION["owner_id"] ;
			$result_delete= mysqli_query($connection, $query_delete);
	
			if(!$result_delete){
				die("DB query failed.");
			}
			header('Location:' .URL. 'login.php');
			 session_destroy();
		}
		else{
			header('Location:' .URL. 'index.php');
		}
	
	}
	if (isset($_POST['submit'])) 
    {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$query  = "SELECT * FROM tbl_ownerdog_207 WHERE owner_email='" 

		. $_POST["email"] 
	 
		. "' and owner_pass='"
	 
		. $_POST["password"]
	 
		."'";
		$result = mysqli_query($connection, $query);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['owner_id']=$row['owner_id'];
			$_SESSION['owner_name'] = $row['owner_name'];
			$_SESSION['owner_email'] = $row['owner_email'];
			$_SESSION['owner_phone'] = $row['owner_phone'];
			$_SESSION['owner_city'] = $row['owner_city'];
			$_SESSION['owner_address'] = $row['owner_address'];
			$_SESSION['post_code'] = $row['post_code'];
			$_SESSION['owner_url'] = $row['owner_picture'];
			mysqli_free_result($result);
			mysqli_close($connection);
			header('Location:' .URL. 'index.php');
			exit(1);
		} else {
			echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
            $message = "Invalid Username or Password!";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="includes/css/style.css">

	<title>Login</title>
</head>
<body id="loginlayout">
	<div class="containerlogin">
		<form action="" method="POST" class="login-email">
			<section><p class="loginimage"></p></section>
			<p class="login-text" style="font-size: 1.5rem; ">MR.DOG</p>
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
            <div class="error-message"><?php if(isset($message)) { echo "&#10008;  ".$message; } ?></div> 
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>

<?php
        mysqli_free_result($result);
    ?>

</html>

<?php

//close DB connection

mysqli_close($connection);

?>
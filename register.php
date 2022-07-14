<?php 

include 'db.php';
include "config.php";

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
	header('location:'.URL.'login.php');
}
$owner_url=$_SESSION["owner_url"];
if(!$owner_url) $owner_url = "images/upload/defultimage.jpg";

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone= $_POST['owner_phone'];
  $city= $_POST['owner_city'];
  $address= $_POST['owner_address'];
  $postcode=$_POST['post_code'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $owner_url=$_POST['owner_url'];

  if ($password == $cpassword) {
	$sql = "SELECT * FROM tbl_ownerdog_207 WHERE owner_email='$email'";
	$result = mysqli_query($connection, $sql);
	if (!$result->num_rows > 0) {
	  $sql = "INSERT INTO tbl_ownerdog_207 (owner_name, owner_email, owner_pass,owner_phone,owner_city,owner_address,post_code,owner_picture)
		  VALUES ('$username', '$email', '$password',' $phone','$city','$address',' $postcode','$owner_url')";
	  $result = mysqli_query($connection, $sql);
	  if ($result) {
		echo "<script>alert('Wow! User Registration Completed.')</script>";
		$username = "";
		$email = "";
		$phone = "";
		$city = "";
		$address= "";
		$postcode = "";
		$_POST['password'] = "";
		$_POST['cpassword'] = "";
		$_POST['owner_url'] = "";
		header('location:'.URL.'login.php');
	  } else {
		echo "<script>alert('Woops! Something Wrong Went.')</script>";
	  }
	} else {
	  echo "<script>alert('Woops! Email Already Exists.')</script>";
	}
	
  } else {
	echo "<script>alert('Password Not Matched.')</script>";
  }
}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="includes/css/style.css"/>

	<title>Register Form - Pure Coding</title>
</head>
<body id="loginlayout">
	<div class="containerlogin">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="tel" placeholder="Phone" name="owner_phone" value="<?php echo $phone;?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="City" name="owner_city" value="<?php echo $city; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Address" name="owner_address" value="<?php  echo $address; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="PostCode" name="post_code" value="<?php echo $postcode; ?>"  required>
			</div>
			<div class="input-group">
					<select  name="owner_url" data-selected="">
						
							<option >images/upload/defultimage.jpg</option>
							<option >images/upload/waled.jpg</option>
							<option >images/upload/hade.jpg</option>
							<option >images/upload/Sarah-modified.png</option>

					</select>
				<!--<input type="text" placeholder="Picture" name="owner_url" value="?>" required>-->
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
	
    <?php
        mysqli_free_result($result);
    ?>

</body>
</html>

<?php

//close DB connection

mysqli_close($connection);

?>
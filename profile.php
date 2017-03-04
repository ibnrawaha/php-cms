<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>


<div id="page">
	
<?php

	if(isset($_GET['proccess']) && $_GET['proccess'] == "update"){
		echo '
			<form action="profile.php?proccess=update" method="post">
				Username: <input type="text" name="username" value="'.get_users_data($conn, "username").'"><br>
				E-mail: <input type="text" name="email" value="'.get_users_data($conn, "email").'"><br>
				Password: <input type="password" name="password" placeholder="Enter New Password"><br>
				Re-Password: <input type="password" name="repassword" placeholder="Enter New Password"><br>
				<button name="submit" type="submit">Update Profile</button>
			</form>
		';
	}else{
		echo "Username: ".get_users_data($conn, "username");
		echo "<br>";
		echo "E-mail: ".get_users_data($conn, "email");
		echo "<br>";
		echo '
			<a href="profile.php?proccess=update">Update Profile</a>
		';
	}
	
	$errors = array();
	
	if(isset($_POST['submit'])){
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string ($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$repassword = mysqli_real_escape_string($conn, $_POST['repassword']);
		
		// unique username
		$query = "SELECT * FROM users WHERE username = '$username';";
		$validate_username = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($validate_username) > 0 ){
			// if the user didn't change the username will get no errors
			if ($username != $_SESSION['username']){
				$errors[] = "Choose another username";
			}
		}
		
		// unique email address
		$query = "SELECT * FROM users WHERE email = '$email';";
		$validate_email = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($validate_email) > 0){
			// if the user didn't change the email address will get no errors
			if ($email != get_users_data($conn, "email")){
				$errors[] = "Email entered already exist";
			}
		}
		
		// validate email format
		if (!preg_match("/@/", $email) && $email !== ""){
			$errors[] = "Please type valid email address.";
		}
		
		//password matching
		if($password !== $repassword){
			$errors[] = "Password doesn't match";
		}
		
		if(empty(trim($username)) || empty(trim($email)) || empty(trim($password)) || empty(trim($repassword))){
			$errors[] = "Please don't leave blank fields";
		}
		
		
		if(count($errors) == 0){
			$hashed_pass = password_hash($password , PASSWORD_BCRYPT, array("cost" => 12));
			
			$query = "UPDATE users SET username = '".$username."' , email = '".$email."' , password = '".$hashed_pass."' WHERE id = '".get_users_data($conn, "id")."' ;";
			$update_profile = mysqli_query($conn , $query);
			if(!$update_profile){
				echo mysqli_error($conn);
			}
			$_SESSION['username'] = $username;
			header ("Location: profile.php");
		}else {
			foreach ($errors as $msg){
				echo "<li>" . $msg . "</li>";
			}
		}
	}else{
		$username = $email = $password = $repassword = "";
	}
	
	
?>


</div>



<?php include "includes/footer.php"; ?>
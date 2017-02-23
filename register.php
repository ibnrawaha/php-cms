<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>


<div id="page">
	<div class="form_container">
		<div class="error_msg">

<?php

/*		//=====================================================		
		//================ Validation errors ==================
		//=====================================================		
		//Check if username unique
		$query = "SELECT * FROM users WHERE username = '{$username}';";
		$unique_username = mysqli_query($conn, $query);
		if (!$unique_username){
			echo mysqli_error($conn);
		}
		while ($row = mysqli_fetch_assoc($unique_username)){
			if(count($row["username"]) > 0){
				$errors[] = "This username is taken, Please choose another one.";
				break;
			}
		}

		//Check if email unique
		$query = "SELECT * FROM users WHERE email = '{$email}';";
		$unique_email = mysqli_query($conn, $query);
		if (!$unique_email){
			echo mysqli_error($conn);
		}
		while ($row = mysqli_fetch_assoc($unique_email)){
			if(count($row["email"]) > 0){
				$errors[] = "This Email is already a registered, Please login.";
				break;
			}
		}

		//Validate Email Address
		if (!preg_match("/@/", $email) && $email !== ""){
			$errors[] = "Please type valid email address.";
		}

		//Password Verfication
		if ($password !== $repassword){
			$errors[] = "Please type match passwords.";
		}
		mysqli_free_results($unique_username);
		mysqli_free_results($unique_username);

		//=====================================================
		//================= End of validation =================
*/		//=====================================================




		//+++++++++++++++++++++++++++++++++++++++++++++++++++++
		//+++++++++++++++++++ validation2 +++++++++++++++++++++
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++
	
	
	$errors = array(); 
	
	if(isset($_POST["submit"])){

		//assigning inputs to variables
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$repassword = $_POST["repassword"];

		$query = "SELECT * FROM users WHERE username = '" . $username . "';";
		// $query = "SELECT * FROM users;";

		$users_set = mysqli_query($conn, $query);
		if (!$users_set){
			echo mysqli_error($conn);
		}
		
		//unique username
		if (mysqli_num_rows($users_set) > 0 ){
			$errors[] = "Username already taken.";
		}
		
		$query = "SELECT * FROM users WHERE email = '" . $email . "';";
		$email_set = mysqli_query($conn, $query);
		
		//unique email
		if (mysqli_num_rows($email_set) > 0 ){
			$errors[] = "Email already registered.";
		}
		

		//Validate Email Address
		if (!preg_match("/@/", $email) && $email !== ""){
			$errors[] = "Please type valid email address.";
			// break;
		}

		//Password Verfication
		if ($password !== $repassword){
			$errors[] = "Please type match passwords.";
		}



		//+++++++++++++++++++++++++++++++++++++++++++++++++++++
		//+++++++++++++++ end of validation2 ++++++++++++++++++
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++

		if(count($errors) == 0){

			//Hashing password
			$hashed_pass =  password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 12));

			// Validation true
			$query  = "INSERT INTO users (username, email, password) ";
			$query .= "VALUES ('$username', '$email', '$hashed_pass');";


			$fill_reg = mysqli_query($conn, $query);
			if (!$fill_reg) {
				echo mysqli_error($conn);
			}
			redirect("register.php?proccessing=done");
			
		}else {

			// Validation false
			// echo $errors;
			foreach ($errors as $key => $value) {
				echo "$value<br>";
			}
		}
		// mysqli_free_results($fill_reg);
	}else {
		//setting default values for inputs
		$username = $email = $password = $repassword = "";
	}
		
		
		// $query = "SELECT * FROM users;";
		// $test = mysqli_query($conn, $query);
		// if (!$test){
			// echo mysqli_error($conn);
		// }
		// $i = 0;
		// while ($row = mysqli_fetch_assoc($test)){
			// foreach($row as $key => $value){
				// if($key == "username" ){
					// if (strtolower($username) == strtolower($value)){
						// $errors .= "Username already taken.<br>";
					// }
				// }
			// }
		// }
		


?>
		</div>


		<form action="register.php" method="post" class="reg_form">
			<input type="text" name="username" required placeholder="Choose Username">
			<input type="text" name="email" required placeholder="Enter Email">
			<input type="password" name="password" required placeholder="Choose Password">
			<input type="password" name="repassword" required placeholder="Retype Password">
			<button type="submit" name="submit" value="submit">Submit</button>
		</form>
	</div>
</div>




<div>
	<form action="register.php" method="post">
		<input type="text" name="user_test">
		<button type="submit" name="test_btn"></button>
	</form>
</div>
<?php
	if(isset($_POST['test_btn'])){
		$users_test = get_users_data($conn, "username");
		echo in_array(strtolower($_POST['user_test']) , $users_test);
	}
?>

<?php include "includes/footer.php"; ?>
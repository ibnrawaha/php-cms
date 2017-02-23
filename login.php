<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>








<div id="page">
	<div class="form_container">

		<div class="error_msg">
			<?php
			if (isset($_POST["submit"])){

				$username = $_POST["username"];
				$password = $_POST["password"];
				
				$query = "SELECT * FROM users WHERE username = '$username';";
				$verify_pass = mysqli_query($conn, $query);
				
				//check if username entered is already in database
				if (mysqli_num_rows($verify_pass) > 0 ){
					//username exist
					while($row = mysqli_fetch_assoc($verify_pass)){
						if(password_verify($password, $row['password'])){
							//set SESSION username from input
							$_SESSION['username'] = $username;
							//set SESSION admin status from database
							$_SESSION['admin'] = $row['admin'];
							//redirect to index after login
							header ('location: index.php?action=login');
							// echo "login successful";
						}else {
							echo "Password not match";
						}
					}
				}else {
					//username not exist
					echo "Username not exist, <a href='register.php'>Join us!</a>";
				}
				mysqli_free_result($verify_pass);

			}else {
				$username = $password = "";
			}
			?>
		</div>
		<form action="login.php" method="post" class="reg_form">
			<input type="text" name="username" placeholder="Enter Username">
			<input type="password" name="password" placeholder="Enter Password">
			<button type="submit" name="submit" value="Login">Login</button>
		</form>
	</div>

</div>

<?php include "includes/footer.php"; ?>
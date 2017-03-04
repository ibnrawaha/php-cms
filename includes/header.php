<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "includes/functions.php"; ?>

<?php 
	

	//unsetting session when logout
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		session_unset();
		header("location: index.php");
	}
?>

<?php
	//blocking pages for members or users
	$file =  basename($_SERVER['PHP_SELF']);
	//Pages that will not be accessible for members
	if(isset($_SESSION['username'])){
		if($file == "register.php" || $file == "login.php"){
			header("location: index.php");
		}
	// Pages that will not be accessible for normal users
	}else{
		if($file == "add_page.php" || $file == "drop_page.php" || $file == "todo.php" || $file == "mytodo.php")
			header("location: index.php");
	}
?>

<html>
<head>
	<link rel="stylesheet" href="style.css" type="text/css">
	<title></title>
</head>
<body>
	<div id="main">
		<div id="nav">
			<h1><a href="index.php" style="color:white; text-decoration:none;">Welcome to the C.M.S.</a></h1>
			
			
			<p>
			<?php
			if(isset($_SESSION['username'])){
				// todo notifications counter
				echo "<a href='index.php?action=logout'>Logout</a>";
				echo " | Welcome, " . $_SESSION['username'];
				echo "<br>";
				
				//todo counter
				$query = "SELECT * FROM todo WHERE username = '".$_SESSION['username']."';";
				$getting_todo = mysqli_query($conn, $query);
				$todo_counter = mysqli_num_rows($getting_todo);
				if ($todo_counter == 0){
					echo "You have <b><a href='mytodo.php' style='text-decoration:none; color:red; background-color:yellow;'>(0)</a></b> TODO tasks.";
				}else{
					echo "You have <b><a href='mytodo.php' style='text-decoration:none; color:red; background-color:yellow;'>(".$todo_counter.")</a></b> TODO tasks.";
				}
				mysqli_free_result($getting_todo);
				echo '<br><a href="profile.php">My Profile</a>';
			}else {
				echo "<a href='login.php'";
				if (basename($_SERVER['PHP_SELF']) == "login.php"){
					echo "class = 'selected'";
				}
				echo ">Login</a> |  ";
				echo "<a href='register.php'";
				if (basename($_SERVER['PHP_SELF']) == "register.php"){
					echo "class = 'selected'";
				}
				echo ">Register</a>";
			}
			?>
			</p>
			
		</div>

		


<?php
		//checking for user status === admin or not admin
		if(isset($_SESSION['username'])){
			$visible_for_admin = get_users_data($conn, "admin");
		}else {
			$visible_for_admin = 0 ;
		}
?>

<?php 
	if (isset($_GET["menu"]) && !isset($_GET['page'])){
		$selected_menu = $_GET["menu"];
		$selected_page = "";
	}elseif (isset($_GET["page"])){
		$selected_page = $_GET["page"];
		$selected_menu = $_GET["menu"];
	}else {
		$selected_menu = $selected_page = "";
	}
?>
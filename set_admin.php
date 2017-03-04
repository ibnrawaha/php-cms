<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>

<?php 
	//make set admin page not accessible for none members or regular users
	if(!isset($_SESSION['username']) || $_SESSION['admin'] == 0){
		header("location: login.php");
	}
?>

<div id="page">
	<form method='post' action='set_admin.php'>
	Search for particular user:<br>Or hit search to look into database<br><input type="text" name="search">
	<input type="submit" name="search_btn" value="Search"><br>
<?php 
	//Search for users to pick admins
	if(isset($_POST['search_btn'])){
		$query = "SELECT * FROM users ";
			if (empty($_POST['search'])){
				
				//when blank input retrieve all users
				$query .= "ORDER BY username ASC;";
			}else {
				
				//searching for particular user
				$query .= "WHERE username = '" . $_POST['search'] . "' ORDER BY username ASC;";
			}
		$get_users = mysqli_query($conn, $query);
		if(!$query){
			echo mysqli_error($conn);
		}
		while ($row = mysqli_fetch_assoc($get_users)){
			echo $row['username'];
			
			if ($row['author'] == 0){
				//setting [Set admin] & [Drop admin] buttons depending on user status from database
				if ($row['admin'] == 0){
					
					//Case 1 (user not admin)
					echo "<button type='submit' name='set_admin' value='".$row['username']."'>Set Admin</button>";
				}else { 
				
					//Case 2 (user is an admin)
					echo "<button type='submit' name='drop_admin' value='".$row['username']."'>Drop Admin</button>";
				}
			}else {
				echo " <b style='color:red;'>Founder</b>";
			}
			echo "<br>";
		}
		mysqli_free_result($get_users);
		echo "</form>";
	}
	
	$query = "";
	if(isset($_POST['set_admin'])){
		//query for setting admin , case 1
		$query = "UPDATE users SET admin = 1 WHERE username = '".$_POST['set_admin']."';";
		echo $query;
	}
	elseif (isset($_POST['drop_admin'])){
		//query for dropping admin , case 2
		$query = "UPDATE users SET admin = 0 WHERE username = '".$_POST['drop_admin']."';";
		echo $query;
	}
	if($query){
		$admin = mysqli_query($conn, $query);
		if(!$query){
			echo mysqli_error($conn);
		}
	}
	

?>
	
	
	
	
</div>
<?php include "includes/footer.php"; ?>
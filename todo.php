<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>

<div id="page">

<?php

//////////////////////////////////////////////////////
	if(empty($_SESSION['tasks'])){
		$_SESSION['tasks'] = 1;
	}elseif (isset($_POST['add'])){
		$_SESSION['tasks']++;
	}elseif (isset($_POST['reset'])){
		$_SESSION['tasks'] = 1;
	}elseif (isset($_POST['del'])){
		$_SESSION['tasks']--;		
	}

?>


<form action="todo.php" method="post" class="reg_form">
	<button name="add" type="submit">Add Task</button><br>
	<button name="reset" type="submit">Reset</button><br>
	<button name="del" type="submit">Delete Task</button><br>
</form>

<?php 
	$task = $_SESSION['tasks'];

	echo '
	<form action="todo.php" method="post" class="reg_form">
	';
	for($inputs = 0; $inputs < $task; $inputs++){
		
		echo '
			<input class="todo_task_input" name="title[]" type="text" placeholder="Enter TODO Task"><br>
			<input class="todo_date_input" name="date[]" type="text" placeholder="TODO Date (Optional)" onfocus='."(this.type='date')".' onblur='."(this.type='text')".'><br>
		';
	
	}
	echo '
		<button class="" name="submit">Publish ' . $task ;
		if($task == 1){
			echo ' Task';
		}else{
			echo ' Tasks';
		}
		echo '</button><br>
	</form>
	';
?>

<?php

	// if user submitted task/s and he is really a member.
	if(isset($_POST['submit']) && isset($_SESSION['username'])){
		$title = $_POST['title'];
		$date = $_POST['date'];
		$username = $_SESSION['username'];
		
		// check if task inputs empty 
		if(!empty($title[$inputs-1]) && !empty($title[0]) ){
			// loop to seperate task array and date array so i can save it as a single mysql row
			for($row=0 ; $row < $inputs ; $row++){
				$query = "INSERT INTO todo (task, date, username) VALUES ('$title[$row]', '$date[$row]', '$username');";
				$add_todo = mysqli_query($conn , $query);
				if(!$add_todo) {
					echo mysqli_error($conn);
				}
				header ("location: mytodo.php");
			}
		}else { echo 'Tasks need to be filled'; }
	}elseif(!isset($_SESSION['username'])){
		echo 'Please Login To Add Your TODO Tasks :)';
	}

	

?>





</div>
<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>
<div id="page">
<?php
	if(isset($_POST['delete'])){
		$query = "DELETE FROM todo WHERE id = '".$_POST['delete']."';";
		$delete_task = mysqli_query($conn, $query);
		// if(!$delete_task){
			// echo mysqli_error($conn);
		// }
		header ("Location: mytodo.php");
		exit;
	}
	if(isset($_SESSION['username'])){
		// tasks ordered by id descending
		$query = "SELECT * FROM todo WHERE username = '".$_SESSION['username']."' ORDER BY id DESC;";
		$get_todo = mysqli_query($conn, $query);
		
		if(!$get_todo){
			echo mysqli_error($conn);
		}
	}
	
	// echo '
	// <form action="todo.php" method="post" ><button class="todo_delete" >Add New TODO</button></form>
	// ';
	
	echo '
	<div class="todo_container" style"background-color:navy;">
		<div class="todo_task"><b>TODO Task</b></div>
		<div class="todo_date"><b>TODO Date</b></div>
		<div class="todo_publish"><b>Published At</b></div>
	</div>
	';
		// <div class="todo_date"><b>Delete TODO</b></div>
	if(isset($_SESSION['username'])){
		// $_SESSION['todo_counter'];
		$counter = 0;
		while($row = mysqli_fetch_assoc($get_todo)){
			
			// create date from mysql publish 	date
			$date = date_create($row['publish_date']);
			
			// discard empty todo tasks
			if($row['task'] != ""){
				$counter ++ ;
				$_SESSION['todo_counter'] = $counter;
				// unset($_SESSION['todo_counter']);
				echo '<div class="todo_container">';
				echo '<div class="todo_task">'.$row['task'].'</div>';
				if ($row['date'] != 0){
					echo '<div class="todo_date">'.$row['date'].'</div>';
				}else{
					echo '<div class="todo_date">No Date Set</div>';
				}
						// formate the date we've just created
				echo '<div class="todo_publish">'.date_format($date, 'Y-m-d H:i:s').'</div>';
				echo '<div><form  method="post" ><button name="delete" class="todo_delete" value='.$row['id'].'>Delete</button></form></div></div>';
				// echo $_POST['delete'];
			}
		}
	}

?>
























</div>

<?php include "includes/footer.php"; ?>
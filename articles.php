<?php
session_start();

// Reset to 1
if(isset($_POST['reset'])){unset($_SESSION['number']);}

// Set or increment session number only if button is clicked.
if(empty($_SESSION['number'])){
    $_SESSION['number']= 1;
}elseif(isset($_POST['next'])){
    $_SESSION['number']++;
}elseif(isset($_POST['back'])){
    $_SESSION['number']--;
}

echo '
<form action="" method="POST">
   <button class="big_b" type="submit" name="next">Add Task</button><br>
   <button type="submit" name="reset">Reset</button><br>
   <button class="big_b" type="submit" name="back">Delete Task</button>
</form>';

echo $_SESSION['number'];


for ($i = 0 ; $i < $_SESSION['number'] ; $i++){
	// echo "<div style='width:50px; height:50px; background-color:red; margin:2px; float:left;'>$i</div>";
	echo '
		<div>
			<form action="articles.php" method="post">
			<div style="padding:5px;">
				<input class="task" type="text" name="task'.$i.'" placeholder="Enter Task" style="width:200px;"><br>
				<input class="date" type="date" name="date'.$i.'" style="width:200px;"><br>
			</div>
		';
	// if(isset($_POST['publish'])){
		// $task = $_POST["task".$i];
		// $date = $_POST["date".$i];
		
		
	// }
}
?>
				<button type="submit name="publish" style="width:200px;">Publish Task</button>
			</form>
		</div>

<?php

	$d= 1;
	for($c= 0 ; $c < $i ; $c++){
		if(isset($_POST["task".$c]) && isset($_POST["date".$c])){
			echo $d . " -  <br>";
			echo "  Task: " . $_POST["task".$c] . "<br>";
			echo " Dead Line: " . $_POST["date".$c] . "<br>";
		}
		$d++;
	}
	
	


echo "<pre>";
print_r($_POST);
echo "</pre>";

?>



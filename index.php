<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>

<div id="page">

	<?php 
	
	
	//showing page title and content from the database by function I defined
	if(isset($_GET['page'])){
		echo "<h2>" . ucwords(get_pages_data($conn , "pages")) . "</h2>";
		if ($visible_for_admin == 1){
			// echo you are in a none/visible menu and none/visible page.
			echo "
			** You are in a " . (get_visiblity($conn, "menu",null) == 1 ? "<b style='color:green;'>Visible Menu </b>" : "<b style='color:red;'>None Visible Menu </b>") . "and a " . (get_visiblity($conn, null,"page") == 1 ? "<b style='color:green;'>Visible Page </b>**" : "<b style='color:red;'>None Visible Page</b> **")
			;
			echo "</pre>";
		}
		echo "<br>";
		echo "<p>" . ucfirst(get_pages_data($conn , "content")) . "</p>";
		
		//showing "Edit Page" link for admins only
		if ($visible_for_admin == 1){
			echo "<a href='index.php?menu=".strtolower(urlencode($selected_menu))."&page=".strtolower(urlencode($selected_page))."&edit=EditPage'>Edit Page</a>";
		}
	}

	
	// Adding inputs to edit the page
	if(isset($_GET['edit']) && $_GET['edit'] == "EditPage"){
		echo '<div class="edit_page">';
		echo '<form method="post" action="index.php?menu='.strtolower(urlencode($selected_menu)).'&page='.strtolower(urlencode($selected_page)).'&edit=EditPage">';
		echo '<input type="text" name="title" class="edit_title">';
		echo '<textarea type="text" name = "content" class="edit_content"></textarea>';
		echo '<button type="submit" name ="edit">Edit Page</button>';
		echo '</form>';
		echo '</div>';
		
		
		//proccessing editing after submitting edits
		if(isset($_POST['edit'])){
			$edit_title = $_POST['title'];
			$edit_content = $_POST['content'];
			
			// trim is a good way to avoid white spaces 
			if(empty(trim($edit_title))){
				$dest = 'index.php?menu='.strtolower(urlencode($_GET['menu'])).'&page='.strtolower(urlencode($_GET['page'])) . '&edit=EditPage';
				// header ("Location: $dest");
				echo "Please enter page title";
				
			}else{
				$query = "UPDATE pages SET pages = '". $edit_title ."' , content = '".$edit_content."' WHERE pages = '".$_GET['page']."';";
				$edit_page = mysqli_query($conn, $query);
				if(!$edit_page){
					echo mysqli_error($conn);				
				}
			// I needed to change the GET data to avoid errors 
				$_GET['page'] = $edit_title;
				header("location: index.php?menu=".strtolower(urlencode($selected_menu))."&page=".strtolower(urlencode($_GET['page'])));
			}
		}
	}
	
	

	
	?>



<?php include "includes/footer.php"; ?>
			

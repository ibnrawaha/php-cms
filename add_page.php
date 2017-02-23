<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>

<div id="page" >

<div class="reg_form">
	<form  action="add_page.php" method="post">
		<input class="edit_title" type="text" name="new_menu" placeholder="Enter New Menu Name">
		<select class="edit_title" name="exist_menu" >
			<option value="" disabled selected>Or Select Existing Menu</option>
			<?php
				while($row = mysqli_fetch_assoc($get_menu)){
					$menu_name = $row['menu_name'];
					echo '
						<option value="'.$row['menu_name'].'">'.$row['menu_name'].'</option>
					';
				}
			?>
		</select>
		<input class="edit_title" type="text" name="page_title" placeholder="Enter Page Title">
		<textarea class="edit_content" type="text" name="page_content" placeholder="Enter Page Content"></textarea>
		<input class="checkbox" type="checkbox" name="menu_visible">Not a visible menu<br>
		<input class="checkbox" type="checkbox" name="page_visible">Not a visible page<br>
		<button  type="submit" name="add_page">Add Page</button>
	</form>

</div>

	

	<?php
		// var_dump($_POST);
		
		if(isset($_POST['add_page'])){
			$page_title =$_POST['page_title'];
			$page_content =$_POST['page_content'];
			
			// defining new menu 
			if(isset($_POST['new_menu']) && !isset ($_POST['exist_menu'])){
				$new_menu = $_POST['new_menu'];
				$menu = "";
			}elseif (isset($_POST['exist_menu']) && empty(trim($_POST['new_menu']))) {
				$menu = $_POST['exist_menu'];
				$new_menu = "";
			}elseif (isset($_POST['new_menu']) && isset ($_POST['exist_menu'])){
				$menu = $_POST['exist_menu'];
				$new_menu = "";
			}
			
			///////////////////////////////////////////////////////////////////////////
			// NOTE :: INCASE NEW MENU i HAVE TO INSERT INTO PAGES AND ALSO MENU TABLES
			///////////////////////////////////////////////////////////////////////////
			
			$query = "SELECT MAX(position) FROM menu;";
			$max_menu_position = mysqli_query($conn ,$query);
			$max_menu_position = mysqli_fetch_row($max_menu_position);
			$new_menu_position = $max_menu_position[0] + 1;
			// echo $query. "<br>";
			
			// menu visibility
			if(isset($_POST['menu_visible'])){
				$visible = 0;
			}else {
				$visible = 1;
			}
			
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			// I NEED THE ID FOR THE MENU TO BE THE SAME ID FOR THE PAGE
			
			if(isset($new_menu) && !empty(trim($new_menu))){
				$query = "INSERT INTO menu (menu_name , position, visible) VALUES ('$new_menu', '$new_menu_position' ,'$visible');";
				$add_menu = mysqli_query($conn,$query);
			}
			echo $query. "<br>";
			echo mysqli_error($conn);
			
			
			
			///////////////////////////////////////////////////////////////////////////
			// NOTE :: INCASE NEW MENU i HAVE TO INSERT INTO PAGES AND ALSO MENU TABLES
			///////////////////////////////////////////////////////////////////////////
			
			// page visibility
			if(isset($_POST['page_visible']) || isset($_POST['menu_visible'])){
				$visible = 0;
			}else {
				$visible = 1;
			}
			
			$query = "SELECT menus_id , position FROM pages WHERE menu_name = '".$menu."';";
			$menu_data_from_pages = mysqli_query($conn, $query);
			$menu_data = mysqli_fetch_row($menu_data_from_pages);
			// echo $query. "<br>";
			
			$query = "SELECT MAX(id) FROM menu;";
			$max_id = mysqli_query($conn ,$query);
			$max_id = mysqli_fetch_row($max_id);
			// echo $query. "<br>";
			
			$query = "SELECT MAX(position) FROM pages;";
			$max_position = mysqli_query($conn ,$query);
			$max_position = mysqli_fetch_row($max_position);
			// echo $query. "<br>";
			
			// menu_id , menu_name and position incase if user entered new menu 
			if(isset($new_menu) && !empty(trim($new_menu))){
				$menus_id = $max_id[0];
				$menu_name = $new_menu;
				$position = $max_position[0]+1;
			
			// menu_id , menu_name and position incase if user inserted an existing menus
			}elseif (isset($menu)){
				$menus_id = $menu_data[0];
				$menu_name = $menu;
				$position = $max_position[0]+1;
			}
			
			
			$query = "INSERT INTO pages (menus_id, pages, menu_name, position, visible, content) VALUES ('$menus_id', '$page_title', '$menu_name', '$position', '$visible', '$page_content' );";
			$add_page = mysqli_query($conn , $query);
			echo $query. "<br>";
			// echo $menus_id. "<br>";
			// echo $position. "<br>";
			
			
			header ("Location: add_page.php");
			
			
			
		}
	?>




</div>
<?php include "includes/header.php"; ?>
<?php include_once "includes/menu.php"; ?>


<div id="page">


<form action="drop_page.php" method="post">
	<ul>
		<?php
			while($menu = mysqli_fetch_assoc($get_menu)){
				echo '<li class="menu_to_delete"><input type="checkbox" name="del_menu[]" value="'.$menu['menu_name'].'">';
				echo $menu['menu_name'];
					$query = "SELECT * FROM pages;";
					$get_pages = mysqli_query($conn, $query);
					echo "<ul>";
					while($page = mysqli_fetch_assoc($get_pages)){
						if($page['menus_id'] == $menu['id']){
							echo '<li class="page_to_delete"><input type="checkbox" name="del_page[]" value="'.$page['pages'].'">';
							echo "<b>" . $page['pages'] . "</b></li>"; 
						}
					}
					echo "</ul>";
				echo "</li>";
			}
			echo '<button type="submit" name="drop_page">Delete Page/s</button>';
		?>
	</ul>
</form>
<?php
// var_dump($_POST);
	if(isset($_POST['drop_page'])){
		$del_menu = $_POST['del_menu'];
		$del_page = $_POST['del_page'];
		
		foreach($del_menu as $m){
			if(isset($del_menu)){
				$query = "DELETE FROM menu WHERE menu_name = '".$m."';";
				$delete_menu = mysqli_query($conn, $query);
				if(!$delete_menu){
					echo mysqli_error($conn);
				}
				$query = "DELETE FROM pages WHERE menu_name = '".$m."';";
				$delete_page_with_menu = mysqli_query($conn, $query);
				if(!$delete_page_with_menu){
					echo mysqli_error($conn);
				}
			}
			// echo $m;
		}
		foreach($del_page as $p){
			if(isset($del_page)){
				$query = "DELETE FROM pages WHERE pages = '".$p."';";
				$delete_page = mysqli_query($conn, $query);
				if(!$delete_page){
					echo mysqli_error($conn);
				}
			}
			// echo $p;
		}
		header ("Location: drop_page.php");
	}


?>



</div>
<?php include "includes/footer.php"; ?>
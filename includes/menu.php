<?php include_once "db.php"; ?>
<?php include_once "includes/functions.php" ?>




<!-- OREGINAL MENU -->
<div id="menu">
	<ul class="menu_ul">
	<?php 
	
		//menu query
		//menu incase of admin
		if ($visible_for_admin == 1){
			$query = "SELECT * FROM menu";
		}else{
		//menu incase of regular user
			$query = "SELECT * FROM menu WHERE visible = '1';";
		}
		$m = mysqli_query($conn, $query);
		while ($menu = mysqli_fetch_assoc($m)) {
			$menu_visible = $menu['visible'];
			echo "<li class='menu_li' >";
			echo "<a href='index.php?menu=".strtolower(urlencode($menu["menu_name"]))."'>" . ucwords($menu['menu_name']) . "</a>";
			
			//submenu or pages query 
			//pages incase of admin
			if ($visible_for_admin == 1){
				$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " ;";
			//pages incase of regular user
			}else{
				$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " AND visible = 1;";
			}
			$p = mysqli_query($conn ,$query);
				// echo $_GET["menu"];
				// echo $menu['menu_name'];
			
			echo "<ul class='page_ul'>";
			while ($pages = mysqli_fetch_assoc($p)){
				// SHRINK MENU >> ALLOW ONLY SELECTED MENU TO SHOW THEIR PAGES
				// if($selected_menu == strtolower($menu['menu_name'])){
					echo "<li class='page_li'>";
					echo "<a href='index.php?menu=".strtolower(urlencode($menu["menu_name"]))."&page=".strtolower(urlencode($pages["pages"]))."'>" . ucwords($pages['pages']) . "</a></li>";
				// }
			}
			echo "</ul>";
			
			echo "</li>";
		}
			
		if (isset($_SESSION['username'])){
			echo "<div class='apps'>";
			if ($visible_for_admin == 1) {
				echo "<a href='add_page.php'>Add Page</a><br>";
				echo "<br><a href='drop_page.php'>Delete Page</a><br>";
				echo "<br><a href='set_admin.php'>Set Admins</a><br><br>";
			}
			//echo "<br><br><a href='articles.php'>Articles</a>";
			echo "<a href='todo.php'>TODO Tasks</a><br>";
			echo "<br><a href='mytodo.php'>My TODO</a><br>";
			echo "</div>";
		}
		//free memory
		mysqli_free_result($m);
		mysqli_free_result($p);

	?>
	</ul>
</div>


<!-- OREGINAL MENU 
<div id="menu">
	<ul class="menu_ul">
	<?php 
	/*
		//menu query
		//menu incase of admin
		if ($visible_for_admin == 1){
			$query = "SELECT * FROM menu";
		}else{
		//menu incase of regular user
			$query = "SELECT * FROM menu WHERE visible = '1';";
		}
		$m = mysqli_query($conn, $query);
		while ($menu = mysqli_fetch_assoc($m)) {
			$menu_visible = $menu['visible'];
			echo "<li ";
			if($selected_menu == strtolower($menu["menu_name"])){
				echo "class='selected'";
			}
			echo "><a href='index.php?menu=".strtolower(urlencode($menu["menu_name"]))."'>" . ucwords($menu['menu_name']) . "</a>";
			
			//submenu or pages query 
			//pages incase of admin
			if ($visible_for_admin == 1){
				$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " ;";
			//pages incase of regular user
			}else{
				$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " AND visible = 1;";
			}
			$p = mysqli_query($conn ,$query);
				// echo $_GET["menu"];
				// echo $menu['menu_name'];
			echo "<ul class='page_ul'>";
			while ($pages = mysqli_fetch_assoc($p)){
				// SHRINK MENU >> ALLOW ONLY SELECTED MENU TO SHOW THEIR PAGES
				// if($selected_menu == strtolower($menu['menu_name'])){
					echo "<li ";
					if(isset($selected_page) && $selected_page == strtolower($pages['pages'])) {
						echo "class='selected'";
						}
					echo "><a href='index.php?menu=".strtolower(urlencode($menu["menu_name"]))."&page=".strtolower(urlencode($pages["pages"]))."'>" . ucwords($pages['pages']) . "</a></li>";
				// }
			}
			echo "</ul></li>";
		}
		if ($visible_for_admin == 1) {
			echo "<br><br><a href='add_page.php'>Add Page</a>";
			echo "<br><br><a href='drop_page.php'>Delete Page</a>";
			echo "<br><br><br><br><a href='set_admin.php'>Set Admins</a>";
		}
		
		//echo "<br><br><a href='articles.php'>Articles</a>";
		echo "<br><br><a href='todo.php'>TODO Tasks</a>";
		echo "<br><br><a href='mytodo.php'>My TODO</a>";
		//free memory
		mysqli_free_result($m);
		mysqli_free_result($p);
*/
	?>
	</ul>
</div>
-->



<!-- EDIT MENU
<div id="menu">
	<ul>
		<?php
			// var_dump (get_menu_data($conn, "menu_name"));
			
		?>
	<?php /*
		//menu query
		$query = "SELECT * FROM menu;";
		$m = mysqli_query($conn, $query);
		while ($menu = mysqli_fetch_assoc($m)) {
			echo "<li ";
			if($selected_menu == strtolower($menu["menu_name"])){
				echo "class='selected'";
			}
			echo "><a href='index.php?menu=".strtolower(urlencode($menu["menu_name"]))."'>" . ucwords($menu['menu_name']) . "</a></li>";
			
			//submenu or pages query 
			
				//menu incase of admin
				if ($visible_for_admin == 1){
					$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " ;";
				//menu incase of regular user
				}else{
					$query = "SELECT * FROM pages WHERE menus_id = " . $menu['id'] . " AND visible = 1;";
				}
			$p = mysqli_query($conn ,$query);
			while ($pages = mysqli_fetch_assoc($p)){
				echo "<ul><li ";
				if($selected_page == strtolower($pages['pages'])) {echo "class='selected'";}
				echo "><a href='index.php?page=".strtolower(urlencode($pages["pages"]))."'>" . ucwords($pages['pages']) . "</a></li></ul>";
			}
		}
		if ($visible_for_admin == 1) {
			echo "<br><br><br><br><a href='set_admin.php'>Set Admins</a>";
		}
		
		//free memory
		mysqli_free_result($m);
		mysqli_free_result($p);
*/
	?>
	</ul>
</div>

-->
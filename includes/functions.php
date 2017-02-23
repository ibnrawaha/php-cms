<?php include_once "../cms/db.php"; ?>

<?php 
function redirect($dest){
	header("location: $dest");
	exit;
}

function set_admin($conn, $query){
	global $query;
	$result="";
	// $get_users = mysqli_query($conn, $query);
	// if(!$query){
		// echo mysqli_error($conn);
	// }

	while($row = mysqli_fetch_assoc($get_users)){
		$user = $row['username'];
		$result = $user;
		$result .= "<input name='set_admin' type='checkbox' value=".$user."><br>";
	}

	$result .= "<input type='submit' name='admin' value='Set Admin'>";
	$result .= "<input type='submit' name='drop_admin' value='Drop Admin'>";
	$result .= "</form>";
	
	// $_POST['admin'] = "";
	// $_POST['set_admin']= "";
	

	return $result;
	
}

function get_users_data($conn, $value ){
	// global $admin;
	if (isset($_SESSION['username'])){
		$query = "SELECT * FROM users WHERE username = '" .$_SESSION['username']. "';";
	}else{
		$query = "SELECT * FROM users;";
	}
	$get_user = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($get_user)){
		$result = $row["$value"];
	}
	return $result;
}
	
function get_pages_data($conn, $value){
	$query = "SELECT * FROM pages WHERE pages ='". $_GET['page'] . "';";
	$get_page = mysqli_query($conn, $query);
	// if(!$get_page){
		// echo mysqli_error($conn);
	// }
	$row = mysqli_fetch_assoc($get_page);
		$result = $row["$value"];
		// $page_name = $row['pages'];
	
	// if(isset($page_name) && $_GET['page'] == $page_name){
		return $result;
	// }
	// else {
		// return "Error.. Please type a title for the page!!";
	// }
}
	
function get_menu_data($conn, $value){
	$query = "SELECT * FROM menu;";
	$get_menus = mysqli_query($conn, $query);
	if(!$get_menus){
		echo mysqli_error($conn);
	}
	while($row = mysqli_fetch_assoc($get_menus)){
		$result[] = $row["$value"];
	}
	return $result;
}
	

function get_visiblity($conn, $menu = null, $page = null){
	if(is_null($page)){
		$query = "SELECT visible FROM menu WHERE menu_name = '".$_GET['menu']."';";
	}
	if(is_null($menu)){
		$query = "SELECT visible FROM pages WHERE pages = '".$_GET['page']."';";
	}
	$get_visiblity = mysqli_query($conn, $query);
	$row = mysqli_fetch_row($get_visiblity);
	
	return $row[0];
	
	
}

?>

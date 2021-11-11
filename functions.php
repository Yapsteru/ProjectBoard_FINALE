<?php 
//global file path
$GLOBALS['file_path'] = 'C:\xampp\htdocs\prototype_project_board\prototype_board';

session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'db_fms');

// variable declaration
$username = "";
$email    = "";
$name    = "";
$user_type = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

if (isset($_POST['update_file_btn'])) {
	update_file_btn();
}



if (isset($_POST['uploadfile_btn'])) {
	uploadfile();
}
// call the uploadfile() function if uploadfile_btn is clicked



// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email, $name;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$name    =  e($_POST['name']);
	$email       =  e($_POST['email']);
	$user_type = e($_POST['user_type']);
	$user_group  =  e($_POST['user_group']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($name)) { 
		array_push($errors, "Name is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($user_type)) { 
		array_push($errors, "User type is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			if($user_type=="user"){	$query = "INSERT INTO users (group_id,username, name, email, user_type, password) 
				VALUES('$user_group','$username', '$name', '$email', '$user_type', '$password')";
	  mysqli_query($db, $query);
	  $_SESSION['success']  = "New user successfully created!!";
	  header('location: ../admin/index.php?page=users');}else{
		$query = "INSERT INTO users (group_id,username, name, email, user_type, password) 
				VALUES('$user_group','$username', '$name', '$email', '$user_type', '$password')";
mysqli_query($db, $query);
$_SESSION['success']  = "New user successfully created!!";
header('location: ../admin/index.php?page=users');
	  }
		
		}else{
			$query = "INSERT INTO users (group_id,username, name, email, user_type, password) 
				VALUES('$user_group','$username', '$name', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

// UPLOAD FILE 
function uploadfile() {
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $filename, $path, $user_id;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$filename    =  e($_POST['filename']);
	$file_type    =  e($_POST['file_type']);
	$date_upload       =  e($_POST['date_upload']);
	$user_id = e($_SESSION['user_id']);
	$feedback  =  e($_POST['feedback']);
	$file_path  =  e($_POST['file_path']);

	// form validation: ensure that the form is correctly filled
	if (empty($filename)) { 
		array_push($errors, "Filename is required"); 
	}
	if (empty($file_type )) { 
		array_push($errors, "File type is required"); 
	}
	if (empty($date_upload)) { 
		array_push($errors, "Date Upload is required"); 
	}
	if (empty($user_id)) { 
		array_push($errors, "User ID type is required"); 
	}
	if (empty($feedback)) { 
		array_push($errors, "Feedback is required"); 
	}
	if (empty($file_path)) { 
		array_push($errors, "File path is required");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$user_type = e($_POST['user_type']);
		$query = "INSERT INTO `files` (`f_id`, `user_id`, `filename`, `file_type`, `date_uploaded`, `feedback`, `file_path`) VALUES (NULL, '$filename', '$file_type', '$date_upload', '$user_id', '$feedback', '$file_path');";
		mysqli_query($db, $query);
		$_SESSION['success']  = "New user successfully created!!";
		header('location: ../admin/index.php?page=users');
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE user_id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['user_id'] = $logged_in_user['user_id'];
				$_SESSION['user_type'] = 'admin';
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/index.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['user_id'] = $logged_in_user['user_id'];
				$_SESSION['group_id'] = $logged_in_user['group_id'];
				$_SESSION['user_type'] = 'user';
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}


function update_file_btn(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $filename, $path, $user_id;


	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$file_id    =  e($_POST['file_id']);
	$file_path    =  e($_POST['file_path']);
	$file_name    =  e($_POST['file_name']);
	$file_newname    =  e($_POST['file_newname']);


	// form validation: ensure that the form is correctly filled
	if (empty($file_id)) { 
		array_push($errors, "Filename is required"); 
	}
	if (empty($file_path )) { 
		array_push($errors, "File type is required"); 
	}
	if (empty($file_name )) { 
		array_push($errors, "File type is required"); 
	}
	if (empty($file_newname )) { 
		array_push($errors, "File type is required"); 
	}

	
	$file_old_name = explode(".", $file_name);

	$file_type = $file_old_name[1];

	$rename_new_file_path = "uploads/".$file_newname.$file_type;
	$save_to_db_new_file_path = "../uploads/".$file_newname.$file_type;
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$user_type = e($_POST['user_type']);
		$query = "INSERT INTO `files` (`f_id`, `user_id`, `filename`, `file_type`, `date_uploaded`, `feedback`, `file_path`) VALUES (NULL, '$filename', '$file_type', '$date_upload', '$user_id', '$feedback', '$file_path');";
		mysqli_query($db, $query);
		$_SESSION['success']  = "New user successfully created!!";
		header('location: ../admin/index.php?page=users');
	}


	$oldname =$file_path;
	$newname =$rename_new_file_path;
	
	if (rename($oldname, $newname)) {
		$message = sprintf(
			'The file %s was renamed to %s successfully!',
			$oldname,
			$newname
		);
	} else {
		$message = sprintf(
			'There was an error renaming file %s',
			$oldname
		);
	}
	
}
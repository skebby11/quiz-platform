<?php 

	session_name("UserSession");
	session_start([
    'cookie_lifetime' => 86400,
	]);

	// connect to universal database
	$db = mysqli_connect('localhost', 'rivacms', '', 'my_rivacms');

	//declaring global vars
	$time = date("d/m/Y - H:i:s");
	$year = date("Y"); 
	$month = date("m"); 

	// variables declaration
	$username = "";
	$email    = "";
	$errors   = array(); 


	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}


	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}


	// call the answer() function if answer_btn is clicked
	if (isset($_POST['answer_btn'])) {
		answer();
	}
	

	// LOGOUT
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: index.php");
	}


	// REGISTER USER
	function register(){
		global $db, $errors;
		
		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);
		
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
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
				$query = "INSERT INTO users2 (email, username, user_type, password) 
						  VALUES('$email', '$username', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: quiz.php');
			}else{
				$query = "INSERT INTO users2 (username, email, user_type, password) 
						  VALUES('$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);
				
				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);
				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: quiz.php');				
			}
		}
	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);
		$user = mysqli_fetch_assoc($result);
		return $user;
	}


	// LOGIN USER
	function login(){
		global $db, $email, $errors;
		// grab form values
		$email = e($_POST['email']);
		$password = e($_POST['password']);
		// make sure form is filled properly
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users2 WHERE email='$email' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: quiz.php');
				}
			}else {
				array_push($errors, "Wrong email/password combination");
			}
		}
	}
	// ANSWER FUNCTIONS
	function answer() {
		global $db, $errors;
		// receive all input values from the form
		$answer1  =  e($_POST['answer1']);
		$answer2  =  e($_POST['answer2']);
		$answer3  =  e($_POST['answer3']);
		$answer4  =  e($_POST['answer4']);
		// form validation: ensure that the form is correctly filled
		if (empty($answer1 || $answer2|| $answer3 || $answer4)) { 
			array_push($errors, "Devi rispondere a tutte le domande."); 
		}
		// save user's answers if there are no errors
		if (count($errors) == 0) {
			$query = "INSERT INTO answers (answer1, answer2, answer3, answer4, utente) 
					  VALUES('$answer1', '$answer2', '$answer3', '$answer4', '$id')";
			mysqli_query($db, $query);

			// get id of the created user
			$_SESSION['success']  = "Abbiamo ricevuto le tue risposte, grazie.";
			header('location: thanks.php');
		}
	}

	// LOGGED IN
	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
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
?>

<?php include('functions.php');
		if (isLoggedIn()) {
		$_SESSION['msg'] = "You are already logged in";
		 header('location: quiz.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<link rel="stylesheet" href="style.css">
	

	<title>Signup</title>
</head>
<body>
	
<div class="container">

  <h1 class="mid-padding">Signup</h1>
	<p>Hai gi&agrave; un account? <a href="login.php">Login</a>.</p>
	<div>
		<?php  if (isset($_SESSION['user'])) : ?>
			<strong><?php echo $_SESSION['user']['username']; ?></strong>

			<small>
				<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
				<br>
				<a href="index.php?logout='1'" style="color: red;">logout</a>
			</small>

		<?php else : ?>

		<?php endif ?>
	</div>
	
	
	<?php echo display_error(); ?>
	
	
	<form method="post" action="signup.php" class="big-padding">

		<?php echo $username, $password_2, $email; ?>
		
		<div class="form-group row">
   		 <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
   		 <div class="col-sm-10">
     		 <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
    	 </div>
 	    </div>
		<div class="form-group row">
   		 <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
   		 <div class="col-sm-10">
     		 <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
    	 </div>
 	    </div>
		<div class="form-group row">
   		 <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
   		 <div class="col-sm-10">
     		 <input type="password" name="password_1" class="form-control">
    	 </div>
 	    </div>
		<div class="form-group row">
   		 <label for="inputEmail3" class="col-sm-2 col-form-label">Confirm password</label>
   		 <div class="col-sm-10">
     		 <input type="password" name="password_2" class="form-control">
    	 </div>
 	    </div>
		<div class="form-group row mid-padding">
    		<div class="col-sm-10">
      			<button type="submit" class="btn btn-primary" name="register_btn">Signup</button>
    		</div>
  		</div>
	</form>

</div>

</body>
</html>
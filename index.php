
<?php include('functions.php');

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

  <h1 class="mid-padding">Home</h1>
	<p> </p>
	<div class="mid-padding">
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
	
	
	<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
				<br>
			</div>
		<?php endif ?>
	
	<div class="big-padding">
		<?php  if (isset($_SESSION['user'])) : ?>
		
		
			<a href="login.php"> <h3>VAI AL QUIZ</h3></a>

		<?php else : ?>
		
			<a href="login.php"> <h3>LOGIN</h3></a>

		<?php endif ?>
	</div>
	
	
	
</div>
</body>
</html>
	

<?php include('functions.php');
		if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must be logged in";
		 header('location: login.php');
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
	

	<title>Quiz</title>
</head>
<body>
	
<div class="container">

  <h1 class="mid-padding">Quiz</h1>
	<p>Rispondi alle domande sincermanete ed in modo pertinente.</p>
	<div>
		<?php  if (isset($_SESSION['user'])) : ?>
			<strong><?php echo $_SESSION['user']['username']; ?></strong>

			<small>
				<i  style="color: #888;">(<?php echo $_SESSION['user']['email']; ?>)</i> 
				<br>
				<a href="index.php?logout='1'" style="color: red;">logout</a>
			</small>

		<?php else : ?>

		<?php endif ?>
	</div>
	
	
	<form method="post" action="quiz.php" class="big-padding">

		<?php echo display_error(); ?>

		<div class="form-group row">
   		 <label for="question1" class="col-sm-10 col-form-label domanda">Qual &egrave; a tuo parere il problema maggiore della città?</label><br>
			</div>
   		 <div class="col-sm-10">
     		 <input type="text" name="answer1" class="form-control" >
    	 </div>
 	    

	</form>

</div>

</body>
</html>
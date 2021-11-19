<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Project Board</title>
	<link rel="stylesheet" type="text/css" href="css/login_new.css">
</head>
<body>
		<div class="split left">
			<div class="logo">
				<div class="center_logo">
					<h1>Project Board</h1>
		  			<h3>A Document Monitoring and Management System</h3>
				</div>
	  		</div>
		</div>
		<div class="split right">
			<div class="login_right">
				
				<form method="post" action="login.php">

					<?php echo display_error(); ?>

					<div class="input-group">
						<label>Username</label>
						<input type="text" name="username" >
					</div>
					<div class="input-group">
						<label>Password</label>
						<input type="password" name="password">
					</div>
					<div class="input-group">
						<button type="submit" class="btn" name="login_btn">Login</button>
					</div>
				</form>
			</div>
			
		</div>
</body>
</html>
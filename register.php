<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" type="text/css" href="style/login.css?v=<?php echo time(); ?>">
		<?php 
			include 'login-RegisterValidation.php'; 
		?>
    </head>


<body>
	<div class="wallpaperlogin">
		<div class="header">
		<h2>Register</h2>
		</div>

		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php include 'errors.php'; ?>
		<div class="input-group">
			<label>Username:</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email:</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password:</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password:</label>
			<input type="password" name="password_2">
		</div>
			<label for="gender">Gender:<label><br/>
			<select name="gender">
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
			
			<br>

		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
			
		<p>
			Already a member? <a href="index.php">Sign in</a>
		</p>
		</form>
	</div>
</body>
</html>
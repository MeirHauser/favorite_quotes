<head>
	<style type="text/css">
		input{
			display: block;
		}	
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="date_validation.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			$('#datepicker').datepicker();
			});
		</script>
</head>
<body>
	<?php if(isset($errors)){
		echo $errors;
	}
	if(isset($logout)){
		echo $logout;
	}
	if(isset($login)){
		echo $login;
	} ?>
	<h3>Register</h3>
	<form action = 'register' method = 'post'>
		Name: <input type = 'text' name = 'name'>
		Alias: <input type = 'text' name = 'alias'>
		Email: <input type = 'text' name = 'email'>
		Password: <input type = 'password' name = 'password'>
		<p>* password must contain atleast 8 characters</p>
		Confirm Password: <input type = 'password' name = 'confirm'>
		Birthday: <input type = 'text' id = 'datepicker' name = 'birthday'>
		<input type = 'submit' value = 'Register'>
	</form>
	<h3>Or Login</h3>
	<form action = 'login' method = 'post'>
		Email: <input type = 'text' name = 'email'>
		Password: <input type = 'password' name = 'password'>
		<input type = 'submit' value = 'Login'>
	</form>
</body>
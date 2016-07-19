<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Login - Music Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="content/js/jquery-1.7.1.min.js"></script>
    <script src="content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
	<div data-role="page">
		<div data-role="header"><h1>Music Events Application</h1></div>
    	<div data-role="main" class="ui-content">

			<form action="Uauth/user_auth.php" method="POST" data-ajax="false">

				<label for="text-basic">User name:</label>
				<input name="user_login" id="user_login" value="" type="text" required/>

				<label for="password">Password:</label>
				<input name="user_password" id="user_password" value="" autocomplete="off" type="password" required/>

			    <label><input name="rememberMe" type="checkbox">Remember me</label>

				<input type="submit" class="ui-btn" value="Login" />

			</form>
			<h3 align="center">OR</h3>
			<a href="Uauth/create_user.php" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" data-transition="pop">Create User</a>

		</div>
	</div>
</body>
</html>
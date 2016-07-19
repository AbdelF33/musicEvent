<?php
	require "../config.php";
	require "../functions/functions.php";
	function chargerclasses($class){
			require("../dao/".$class.".class.php");
		}
		spl_autoload_register('chargerclasses');

	$data = new user(HOST, DBNAME, USER, PASSWORD);
	$data->connect();

	/*if($_POST){
		echo $_POST['user']."<br>".$_POST['confirmpass']."<br>".$_POST['mail']."<br><br>";
		foreach ($_POST['select-custom-24'] as $selectedValue){echo $selectedValue."<br>";}
	}*/
	$i=0;
	if (isset($_POST['user']) && isset($_POST['confirmpass']) && isset($_POST['mail']) && isset($_POST['select-custom-24'])) {
		foreach ($_POST['select-custom-24'] as $selectedValue){
			$i++;
			if($i == 1){
				$genre1 = $selectedValue;
			}else if ($i == 2) {
				$genre2 = $selectedValue;
			}else if ($i == 3) {
				$genre3 = $selectedValue;
			}
		}
		
		if ($data->insertUser($_POST['user'], $_POST['confirmpass'], $_POST['mail'], $genre1, $genre2, $genre3)){
			echo "<script>
				alert(\"Your account has been added !\");
				window.location=\"../login_form.php\";		
			</script>";
			
			//call function send mail
			//mail("abdel.ratnane@gmail.com", "test application", "welcome to music events app");
			sendMail($_POST['mail'], $_POST['user']);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>Create user - Music Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="../content/js/jquery-1.7.1.min.js"></script>
    <script src="../content/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<h1>Music Events Application</h1>
			    <a href="#" data-add-back-btn="true" data-rel="back" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-carat-l">Back</a>
		</div>
    	<div data-role="main" class="ui-content">

		    <form action="create_user.php" method="POST" data-ajax="false">
	            <h3>Please Create a new user</h3>
	            <label for="un" class="ui-hidden-accessible">Username:</label>
	            <input name="user" id="un" value="" placeholder="Username" data-theme="a" type="text" required>
	            <label for="pw" class="ui-hidden-accessible">Password:</label>
	            <input name="pass" id="pw" value="" placeholder="Password" data-theme="a" type="password" required>
	            <label for="cpw" class="ui-hidden-accessible">Password:</label>
	            <input name="confirmpass" id="cpw" value="" placeholder="Confirm password" data-theme="a" type="password" onChange="checkPasswordMatch();" required>
	        	<div id="checkPwd"></div>
	        	<label for="mail" class="ui-hidden-accessible">Username:</label>
	            <input name="mail" id="mail" value="" placeholder="Email" data-theme="a" type="email" required>

	        	<label for="gn" class="ui-hidden-accessible">Genre:</label>
				<div class="ui-field-contain">
				    <label for="select-custom-24">You may select up to 3 genres:</label>
				    <select name="select-custom-24[]" id="select-custom-24" data-native-menu="false" multiple="multiple" data-iconpos="left" >
				        <option>Choose your genre</option>
				        <?php 
				        	$genreList = $data->readGenre();
				        	foreach ($genreList as $genre_id => $resultat) {
				        ?>
				        	<option value="<?php echo $resultat->genre_id; ?>"><?php echo $resultat->genre_label; ?></option>
				        <?php } ?>
				    </select>
				</div>

	            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Create</button>
		    </form>

		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	function checkPasswordMatch() {
    var password = $("#pw").val();
    var confirmPassword = $("#cpw").val();

    if (password != confirmPassword)
        $("#checkPwd").html("Passwords do not match!");
    else
        $("#checkPwd").html("Passwords match.");
	}

	$(document).ready(function () {
	   $("#cpw").keyup(checkPasswordMatch);
	});

	//limit multiple select
	jQuery('#select-custom-24').on('change', function() {
		if (this.selectedOptions.length <= 3) {
		    jQuery(this).find(':selected').addClass('selected');
		    jQuery(this).find(':not(:selected)').removeClass('selected');
		} else {

		    jQuery(this)
		    .find(':selected:not(.selected)')
		    .prop('selected', false);
		}
	});

</script>
<?php
	session_start();
	require '../config.php';
	function chargerclasses($class){
			require("../dao/".$class.".class.php");
		}
		spl_autoload_register('chargerclasses');

	$data = new user(HOST, DBNAME, USER, PASSWORD);
	$data->connect();
	//print_r($_POST); 
	if(isset($_POST['user_login']) && isset($_POST['user_password'])){
		if(!$data->auth_user($_POST['user_login'], $_POST['user_password'])){
			$_SESSION['log']= 0;
			echo $data->message();
			echo "
				  <script>
					  alert(\"Erreur authentification !\");
					  window.location=\"../login_form.php\";
				  </script>
				 ";
		}else{
			$_SESSION['log']= 1;
			$info_user = $data->get_user_info($_POST['user_login'], $_POST['user_password']);
			$_SESSION['nom'] = $info_user->user_lastname;
			$_SESSION['prenom'] = $info_user->user_firstname;
			$_SESSION['genre1'] = $info_user->user_genre1;
			$_SESSION['genre2'] = $info_user->user_genre2;
			$_SESSION['genre3'] = $info_user->user_genre3;

		    $app_id = "151331";
		    $app_secret = "df314152a6a081cdb47b30a65b9a96ca";
		    $my_url = "http://vps104447.ovh.net/rila13/projetweb/AbdelR/index.php";
		     
		    session_start();
		    $code = $_REQUEST["code"];
		     
		    if(empty($code)){
		    $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
		     
		    $dialog_url = "https://connect.deezer.com/oauth/auth.php?app_id=".$app_id
		    ."&redirect_uri=".urlencode($my_url)."&perms=email,offline_access"
		    ."&state=". $_SESSION['state'];
		     
		    header("Location: ".$dialog_url);
		    exit;
		     
		    }
		     
		    if($_REQUEST['state'] == $_SESSION['state']) {
			    $token_url = "https://connect.deezer.com/oauth/access_token.php?app_id="
			    .$app_id."&secret="
			    .$app_secret."&code=".$code;
			     
			    $response = file_get_contents($token_url);
			    $params = null;
			    parse_str($response, $params);
			    $api_url = "https://api.deezer.com/user/me?access_token="
			    .$params['access_token'];
			     
			    $user = json_decode(file_get_contents($api_url));
			    echo("Hello " . $user->name);
		    }else{
		    	echo("The state does not match. You may be a victim of CSRF.");
		    }
			
			//echo "Vous &egrave;tes authentifi&eacute;";
			//echo "<script> window.location=\"../index.php\"; </script>";
		}
	}

	$data->disconnect();
?>
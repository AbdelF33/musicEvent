<?php
/**
 * Description of admin
 *
 * @author Abdel
 */
 
 class user extends BDDmusicManager{
	//Afficher les user de la table user
    function auth_user($login, $password){
        $user = array();
        
        $sql = "SELECT * FROM abdelR_users WHERE user_login = '".$login."' AND user_password = '".$password."'";
        
        try {
            $res = $this->pdo->query($sql);
            /*if($resultats = $res->fetch(PDO::FETCH_OBJ)){
                    $user = $resultats;
                }
            return $user;*/
            $row = $res->fetch(PDO::FETCH_NUM);
            $nbrows=$row[0];
            return $nbrows; // 0 ou 1 ligne max ... 
        } catch (Exception $e) {
            $this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
            echo $this->message;
            echo $sql."<br><br>";
            return false;
        }
    }

    function get_user_info($login, $password){
        $resultat = array();
        
        $sql = "SELECT * FROM abdelR_users WHERE user_login = '".$login."' AND user_password = '".$password."'";
        
        try {
            $res = $this->pdo->query($sql);
            if($resultat = $res->fetch(PDO::FETCH_OBJ)){
                    $user = $resultat;
                }
            return $user;
        } catch (Exception $e) {
            $this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
            echo $this->message;
            echo $sql."<br><br>";
            return false;
        }
    }

    function insertUser($login, $password, $email, $genre1, $genre2, $genre3){
        $sql="INSERT INTO abdelR_users(user_login, user_password, user_email, user_genre1, user_genre2, user_genre3) 
                VALUES(
                    '".str_replace("'", "\'", $login)."',
                    '".str_replace("'", "\'", $password)."',
                    '".str_replace("'", "\'", $email)."',
                    '".str_replace("'", "\'", $genre1)."',
                    '".str_replace("'", "\'", $genre2)."',
                    '".str_replace("'", "\'", $genre3)."')";
        try{
            $res=$this->pdo->query($sql);
            echo "Requ&ecirc;te execut&eacute; avec succ&egrave;s !<br>";
            return true;
        }
        catch(PDOException $e){
            $this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
            echo $this->message;
            echo $sql."<br><br>";
            return false;
        }
    }

 }
 ?>
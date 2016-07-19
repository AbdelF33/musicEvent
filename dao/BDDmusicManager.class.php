<?php 
	class BDDmusicManager {

		private $user;
		private $password;
		private $db;
		private $host;
		protected $pdo;
		protected $message;

		function __construct($host, $db, $user, $password){
			$this->host=$host;
			$this->db=$db;
			$this->user=$user;
			$this->password=$password;
		}

		function message(){
			return $this->message;
		}

		function connect(){
			try{
				$this->pdo = new PDO("mysql:dbname=".$this->db.";host=".$this->host, $this->user, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql="SET NAMES 'utf8'";
				$res=$this->pdo->query($sql);
			}
			catch(PDOException $e){
				$this->message = "Erreur de connexion au serveur :<br>".$e->getMessage()."<br>";
				echo $this->message;
				$this->pdo=null;
				return false;
			}
			return true;
		}

		function disconnect(){
			die;
		}

		function insertMusic($album_gn_id, $album_artist, $album_title, $album_genre_id, $album_subGenre_id, $album_subGenre_label, $track_gn_id, $track_artist, $track_title, $track_mood_id, $track_tempo_id, $deezer_id, $coverArt_url){
			$sql="INSERT INTO abdelR_musicData(album_gn_id, album_artist, album_title, album_genre_id, album_subGenre_id, album_subGenre_label, track_gn_id, track_artist, track_title, track_mood_id, track_tempo_id, deezer_id, coverArt_url) 
					VALUES(
						'".str_replace("'", "\'", $album_gn_id)."',
						'".str_replace("'", "\'", $album_artist)."',
						'".str_replace("'", "\'", $album_title)."',
						'".str_replace("'", "\'", $album_genre_id)."',
						'".str_replace("'", "\'", $album_subGenre_id)."',
						'".str_replace("'", "\'", $album_subGenre_label)."',
						'".str_replace("'", "\'", $track_gn_id)."',
						'".str_replace("'", "\'", $track_artist)."',
						'".str_replace("'", "\'", $track_title)."',
						'".str_replace("'", "\'", $track_mood_id)."',
						'".str_replace("'", "\'", $track_tempo_id)."',
						'".str_replace("'", "\'", $deezer_id)."',
						'".str_replace("'", "\'", $coverArt_url)."')";
			try{
				$res=$this->pdo->query($sql);
				echo "Requ&ecirc;te execut&eacute; avec succ&egrave;s !<br>";
			}
			catch(PDOException $e){
				$this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
				echo $this->message;
				echo $sql."<br><br>";
				return false;
			}				
			return true;
		}

		function readMusicData(){
			$musicData=array();
			$sql="SELECT * FROM abdelR_musicData";
			$res=$this->pdo->query($sql);
			while($resultats = $res->fetch(PDO::FETCH_OBJ)){
        		$musicData[$resultats->music_id] = $resultats;
			}
        	return $musicData;
    	}

    	//get the track with gracenote id
    	function readMusicIdTrack($TrackId){
			$Track=array();
			$sql="SELECT * FROM abdelR_musicData WHERE track_gn_id='".$TrackId."'";
			try {
				$res=$this->pdo->query($sql);
				/*if($resultats = $res->fetch(PDO::FETCH_OBJ)){
	        		$Track = $resultats;
				}
	        	return $Track;*/
	            $row = $res->fetch(PDO::FETCH_NUM);
    			$nbrows=$row[0];
            	return $nbrows;
			} catch (Exception $e) {
				$this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
				echo $this->message;
				echo $sql."<br><br>";
			}
    	}

    	//lister les morceaux musicaux par genre selon l'utilisateur
    	function readMusicGenre($genre1, $genre2, $genre3){
            $playlits = array();
            
            $sql = "SELECT * FROM abdelR_users, abdelR_musicData
					WHERE album_genre_id = '".$genre1."'
					OR  album_genre_id = '".$genre2."'
					OR  album_genre_id = '".$genre3."'";
            try {
            	$res = $this->pdo->query($sql);
            
	            while($resultat = $res->fetch(PDO::FETCH_OBJ)){
	        		$playlits[$resultat->music_id] = $resultat;
				}
		        return $playlits;
            } catch (Exception $e) {
            	$this->message = "Erreur d'execution de la requ&ecirc;te :<br>".$e->getMessage()."<br>";
				echo $this->message;
				echo $sql."<br><br>";
            }
            
    	}

		function readGenre(){
			$genre=array();
			$sql="SELECT * FROM abdelR_genre";
			$res=$this->pdo->query($sql);
			while($resultats = $res->fetch(PDO::FETCH_OBJ)){
        		$genre[$resultats->genre_id] = $resultats;
			}
        	return $genre;
    	}

		function readMood(){
			$mood=array();
			$sql="SELECT * FROM abdelR_mood";
			$res=$this->pdo->query($sql);
			while($resultats = $res->fetch(PDO::FETCH_OBJ)){
        		$mood[$resultats->mood_id] = $resultats;
			}
        	return $mood;
    	}
	}
?>
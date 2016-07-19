<?php
    // Inclusion de la classe
    function chargerclasses($class){
        require("../dao/".$class.".class.php");
    }
    spl_autoload_register('chargerclasses');
    require '../config.php';

    $mgt = new BDDmusicManager(HOST,DBNAME,USER,PASSWORD);
    $mgt->connect();

    // Votre Client ID -- exemple : 9656576-61A6ABBDB769FA23E0CD726280F78961 

    // Création de l'objet API et connexion
    $api = new RhythmAPI(CLIENT_ID);

    //Variable comptage
    $insert = 0;
    $notInsert = 0;

    if (isset($_GET['select_genre']) && isset($_GET['select_mood'])) {
      $getGenre = $_GET['select_genre'];
      $getMood = $_GET['select_mood'];

      if ($getGenre == "0"){
        echo "<script> 
                  alert('You must select a genre !');
                  window.location=\"insertMusic.php\";
              </script>";
              exit();
      }else if($getMood == "0"){
        $moodList = $mgt->readMood();
        foreach ($moodList as $mood_id => $resultat) {
          // Affichage des morceaux liés à ce genre et ce "mood"
          $music = $api->requete($getGenre, $resultat->mood_id);

/*echo $resultat->mood_id."<br>".$getGenre;
echo $music."<br><br>";*/

          // Découpage du XML
          $xml_chaine = new SimpleXMLElement($music);

          //Parcours et découpage du fichier XML
          foreach ($xml_chaine->RESPONSE->ALBUM as $list_album) {
              $albumGnId = $list_album->GN_ID;
              $albumArtist = $list_album->ARTIST;
              $albumTitle = $list_album->TITLE;
              $albumGenreId = $getGenre;
              $albumSubGenreId = $list_album->GENRE['ID'];
              $albumSubGenreLabel = $list_album->GENRE;
              $trackGnId = $list_album->TRACK->GN_ID;
              $trackArtist = $list_album->TRACK->ARTIST;
              $trackTitle = $list_album->TRACK->TITLE;
              $trackMood = $resultat->mood_id;
              $trackTempo = $list_album->TRACK->TEMPO['ID'];
              $deezerId = $list_album->TRACK->XID;
              $coverUrl = $list_album->URL;
    //echo $trackMood."<br><br>";
              if (!$mgt->readMusicIdTrack($trackGnId)) {
                   $insert++;
                   $mgt->insertMusic($albumGnId,
                                     $albumArtist,
                                     $albumTitle,
                                     $albumGenreId,
                                     $albumSubGenreId,
                                     $albumSubGenreLabel,
                                     $trackGnId,
                                     $trackArtist,
                                     $trackTitle,
                                     $trackMood,
                                     $trackTempo,
                                     $deezerId,
                                     $coverUrl);
               }else{
                  $notInsert++;
               }
          }
        }
        echo "<script> 
                    alert('Insert track : ".$insert." / Not insert track : ".$notInsert."');
                    window.location=\"insertMusic.php\";
                </script>";
        //header("location: insertMusic.php");     
      }else if ($getMood != "0"){
      
        // Affichage des morceaux liés à ce genre et ce "mood"
        $music = $api->requete($getGenre, $getMood);
/*        
echo $getMood."<br>".$getGenre;
echo $music."<br><br>";*/
        // Découpage du XML
        $xml_chaine = new SimpleXMLElement($music);
        //Parcours et découpage du fichier XML
        foreach ($xml_chaine->RESPONSE->ALBUM as $list_album) {
            $albumGnId = $list_album->GN_ID;
            $albumArtist = $list_album->ARTIST;
            $albumTitle = $list_album->TITLE;
            $albumGenreId = $getGenre;
            $albumSubGenreId = $list_album->GENRE['ID'];
            $albumSubGenreLabel = $list_album->GENRE;
            $trackGnId = $list_album->TRACK->GN_ID;
            $trackArtist = $list_album->TRACK->ARTIST;
            $trackTitle = $list_album->TRACK->TITLE;
            $trackMood = $getMood;
            $trackTempo = $list_album->TRACK->TEMPO['ID'];
            $deezerId = $list_album->TRACK->XID;
            $coverUrl = $list_album->URL;

            if (!$mgt->readMusicIdTrack($trackGnId)) {
                 $insert++;
                 $mgt->insertMusic($albumGnId,
                                   $albumArtist,
                                   $albumTitle,
                                   $albumGenreId,
                                   $albumSubGenreId,
                                   $albumSubGenreLabel,
                                   $trackGnId,
                                   $trackArtist,
                                   $trackTitle,
                                   $trackMood,
                                   $trackTempo,
                                   $deezerId,
                                   $coverUrl);
             }else{
                $notInsert++;
             }
        }
        echo "<script> 
            alert(\"Insert track : ".$insert." / Not insert track : ".$notInsert."\"); 
            window.location=\"insertMusic.php\";
        </script>";
       //redirection
        //echo "<script> window.location=\"insertMusic.php\"; </script>";
        //header("location: insertMusic.php");
      } 
    }
    

    //Deconnexion de la base
    $mgt->disconnect();
    exit();
?>
<?php

    // Inclusion de la classe
    function chargerclasses($class){
        require("../dao/".$class.".class.php");
    }
    spl_autoload_register('chargerclasses');
    //require "BDDmusicManager.class.php";
    //require "RhythmAPI.class.php";
    require '../config.php';

    $mgt = new BDDmusicManager(HOST,DBNAME,USER,PASSWORD);
    $mgt->connect();

    // Votre Client ID -- exemple : 9656576-61A6ABBDB769FA23E0CD726280F78961 

    // Création de l'objet API et connexion
    $api = new RhythmAPI(CLIENT_ID);

    // Affichage des morceaux liés à ce genre et ce "mood"
    $Rock = $api->requete("25964","");

    // Découpage du XML
    $xml_chaine = new SimpleXMLElement($Rock);

    //Parcours et découpage du fichier XML
    foreach ($xml_chaine->RESPONSE->ALBUM as $list_album) {
        $albumGnId = $list_album->GN_ID;
        $albumArtist = $list_album->ARTIST;
        $albumTitle = $list_album->TITLE;
        $albumGenreId = "25964";
        $albumSubGenreId = $list_album->GENRE['ID'];
        $albumSubGenreLabel = $list_album->GENRE;
        $trackGnId = $list_album->TRACK->GN_ID;
        $trackArtist = $list_album->TRACK->ARTIST;
        $trackTitle = $list_album->TRACK->TITLE;
        $trackMood = $list_album->TRACK->MOOD['ID'];
        $trackTempo = $list_album->TRACK->TEMPO['ID'];
        $deezerId = $list_album->TRACK->XID;
        $coverUrl = $list_album->URL;

        if (!$mgt->readMusicIdTrack($trackGnId)) {
             echo "INSERT<br>";
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
            echo "NOT INSERT<br>";
         }
    }

    //Deconnexion de la base
    $mgt->disconnect();

?>
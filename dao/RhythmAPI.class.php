<?php

class RhythmAPI {

    private $clientID;
    private $userID;

    // Constructeur et connexion
    public function __construct($clientID)
    {
        $this->clientID = $clientID;
        $data = $this->prepare("https://c".$clientID.".web.cddbp.net/webapi/xml/1.0/register?client=".$clientID);
        $xml = new SimpleXMLElement($data);
        $this->userID = $xml->RESPONSE->USER->__toString();
    }

    // Méthode qui utilise une url et retourne ses résultats
    private function prepare($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    // Fait une requête et retourne des morceaux en fonction d'un genre et/ou d'un "mood"
    public function requete($genre = "", $mood = "")
    {
        if ($genre != "" || $mood != "") {
            $url = "https://c".$this->clientID.".web.cddbp.net/webapi/xml/1.0/radio/create?";
            $i = 1;
            if ($genre != "") {
                if ($i != 1) {
                    $url .= "&";
                    $i++;
                }
                $url .= "genre=".$genre;
            }
            if ($mood != "") {
                if ($i != 1) {
                    $url .= "&";
                    $i++;
                }
                $url .= "mood=".$mood;
            }

            $url .= "&return_count=25&select_extended=cover,mood,tempo,genre,link&client=".$this->clientID."&user=".$this->userID;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        else {
            return FALSE;
        }

    }
} 
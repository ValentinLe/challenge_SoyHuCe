<?php

/* gestion des requetes sur l'API */
class RequestSearchAPI {

  /* fait une requete avec une recherche sur l'API et un nombre limite donnees */
  static function getSearchWith($search, int $nb) {
    $search = str_replace(" ", "+", $search);
    $url = "https://itunes.apple.com/search?term=" . $search . "&limit=$nb&entity=song";
    $contents = file_get_contents($url);
    return json_decode($contents, true);
  }

  /*
    requete sur l'API avec l'id d'une musique renvoi les donnees de cette musique ou null
    si l'id n'existe pas
   */
  static function getSearchWithId($trackId) {
    $url = "https://itunes.apple.com/lookup?id=$trackId";
    $contents = file_get_contents($url);
    $json = json_decode($contents, true);
    if ($json["resultCount"] === 1) {
      return $json["results"][0];
    } else {
      return null;
    }
  }

  /* requete sur l'API avec une liste id donnee  ex: "1256,1515,1515" */
  static function getSearchWithIds($tracksId) {
    $url = "https://itunes.apple.com/lookup?id=$tracksId";
    $contents = file_get_contents($url);
    return json_decode($contents, true)["results"];
  }
}

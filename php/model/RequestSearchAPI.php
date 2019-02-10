<?php

class RequestSearchAPI {

  static function getSearchWith($search, int $nb) {
    $search = str_replace(" ", "+", $search);
    $url = "https://itunes.apple.com/search?term=" . $search . "&limit=$nb&entity=song";
    $contents = file_get_contents($url);
    return json_decode($contents, true);
  }

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

  static function getSearchWithIds($tracksId) {
    $url = "https://itunes.apple.com/lookup?id=$tracksId";
    $contents = file_get_contents($url);
    return json_decode($contents, true)["results"];
  }
}

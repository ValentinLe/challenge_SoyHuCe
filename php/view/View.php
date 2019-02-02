<?php

class View {

  function makeIndexPage() {
    include("pages/Accueil.php");
  }

  function makeErrorPage() {
    include("pages/Error.php");
  }

  function makeSearchPage($strSearch, array $search) {
    $listResults = "";
    foreach ($search["results"] as $item) {
      $listResults .= $this->getHTMLItem($item);
    }
    include("pages/Search.php");
  }

  function getHTMLItem(array $item) {
    return "<div class='item'>" .
      "<span class='time'>" . $this->getStrDuration($item["trackTimeMillis"]) . "</span>" .
      "<span class='trackName'>" . $item["trackName"] . "</span>" .
      "<span class='artistName'>" . $item["artistName"] . "</span>" .
      "<div class='zoneAudio'><audio controls src=" . $item["previewUrl"] . "></audio></div>" .
      "<button type='submit' name='id' value=" . $item["trackId"] . ">Voir page</button>" .
    "</div>";
  }

  function getIfExist($song, $key) {
    return (key_exists($key, $song) ? $song[$key] : "Non renseigné");
  }

  function makePageSong(array $song) {
    $trackName = $this->getIfExist($song, "trackName");
    $artistName = $this->getIfExist($song, "artistName");
    $srcImage = $this->getIfExist($song, "artworkUrl100");
    $date = $this->getIfExist($song, "releaseDate");
    $trackPrice = $this->getIfExist($song, "trackPrice");
    $collectionName = $this->getIfExist($song, "collectionName");
    $collectionPrice = $this->getIfExist($song, "collectionPrice");
    $genre = $this->getIfExist($song, "primaryGenreName");
    $urlArtist = $this->getIfExist($song, "artistViewUrl");
    $duree = $this->getStrDuration($this->getIfExist($song, "trackTimeMillis"));
    include("pages/Song.php");
  }

  function getStrDuration(int $timeMillis) {
    $secondes = floor($timeMillis/1000);
    $minutes = floor($secondes/60);
    $secondes = $secondes%($minutes*60);
    return $minutes . ":" . (strlen("" . $secondes)===1 ? "0". $secondes : $secondes);
  }

}

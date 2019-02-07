<?php

class View {

  public $feedback;

  function __construct($feedback) {
    $this->feedback = $feedback;
  }

  function makeIndexPage() {
    include("pages/Accueil.php");
  }

  function makeErrorPage() {
    include("pages/Error.php");
  }

  function makeSearchPage(ListItem $listItem) {
    $listResults = "";
    foreach ($listItem->getListItem() as $item) {
      $listResults .= $this->getHTMLItem($item);
    }
    include("pages/Search.php");
  }

  function getHTMLItem(SongItem $item) {
    return
    "<div class='item'>" .
      "<div><img src='" . $item->getValueOf("artworkUrl60") . "' width=60 height=60 /></div>" .
      "<div><span>" . $item->getValueOf("trackName") . "</span></div>" .
      "<div><span>" . $item->getValueOf("artistName") . "</span></div>" .
      "<div><span>" . $this->getStrDuration($item->getValueOf("trackTimeMillis")) . "</span></div>" .
      "<div><button type='submit' name='id' value=" . $item->getValueOf("trackId") . ">Plus</button></div>" .
    "</div>";
  }

  function getIfExist($song, $key) {
    return (key_exists($key, $song) ? $song[$key] : "Non renseigné");
  }

  function makePageSong(SongItem $song) {
    $data = $song->getData();
    $trackId = $this->getIfExist($data, "trackId");
    $trackName = $this->getIfExist($data, "trackName");
    $artistName = $this->getIfExist($data, "artistName");
    $srcImage = $this->getIfExist($data, "artworkUrl100");
    $date = $this->getIfExist($data, "releaseDate");
    $trackPrice = $this->getIfExist($data, "trackPrice");
    $collectionName = $this->getIfExist($data, "collectionName");
    $collectionPrice = $this->getIfExist($data, "collectionPrice");
    $genre = $this->getIfExist($data, "primaryGenreName");
    $urlArtist = $this->getIfExist($data, "artistViewUrl");
    $duree = $this->getStrDuration($this->getIfExist($data, "trackTimeMillis"));
    $extraitURL = $data["previewUrl"];
    include("pages/Song.php");
  }

  function makeListFavoris(ListItem $listItem) {
    $data = $listItem->getListItem();
    $list = "<ul>";
    foreach ($data as $fav) {
      $list .= "<li>" . $fav["titre"] . " " . $fav["genre"] . "</li>";
    }
    $list .= "</ul>";
    include("pages/Favoris.php");
  }

  function getStrDuration(int $timeMillis) {
    $secondes = floor($timeMillis/1000);
    $minutes = floor($secondes/60);
    $secondes = ($minutes != 0 ? $secondes%($minutes*60) : $secondes);
    return $minutes . ":" . (strlen("" . $secondes)===1 ? "0". $secondes : $secondes);
  }

  function makeGraphPage() {
    include("pages/Graph.php");
  }
}

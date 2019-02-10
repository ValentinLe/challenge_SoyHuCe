<?php

class View {

  public $feedback;
  public $isConnected;

  function __construct($feedback, $isConnected) {
    $this->feedback = $feedback;
    $this->isConnected = $isConnected;
  }

  function setConnexion($newState) {
    $this->isConnected = $newState;
  }

  function makeIndexPage() {
    include("pages/Accueil.php");
  }

  function makeErrorPage() {
    include("pages/Error.php");
  }

  function makeSearchPage(ListSongItem $listItem) {
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
    return (key_exists($key, $song) ? $song[$key] : null);
  }

  function strPrice($price) {
    if ($price !== null) {
      $price .= " €";
    } else {
      $price = "Non renseigné";
    }
    return $price;
  }

  function makePageSong(SongItem $song, $isFavoris) {
    $data = $song->getData();
    $trackId = $this->getIfExist($data, "trackId");
    $trackName = $this->getIfExist($data, "trackName");
    $artistName = $this->getIfExist($data, "artistName");
    $srcImage = $this->getIfExist($data, "artworkUrl100");
    $date = $this->getStringDate($this->getIfExist($data, "releaseDate"));
    $trackPrice = $this->strPrice($this->getIfExist($data, "trackPrice"));
    $collectionName = $this->getIfExist($data, "collectionName");
    $collectionUrl = $this->getIfExist($data, "collectionViewUrl");
    $collectionPrice = $this->strPrice($this->getIfExist($data, "collectionPrice"));
    $genre = $this->getIfExist($data, "primaryGenreName");
    $urlArtist = $this->getIfExist($data, "artistViewUrl");
    $duree = $this->getStrDuration($this->getIfExist($data, "trackTimeMillis"));
    $extraitURL = $data["previewUrl"];
    $favoris = "";
    if ($isFavoris === true) {
      $favoris = "
      <p>Ce morceau est présent dans vos favoris.</p>
      <form action=" . Router::getSupprFavoris($trackId) . " method='post'>
        <input type='hidden' name='delTrackId' value=$trackId>
        <button class='buttonRed' type='submit'>Supprimer</button>
      </form>";
    } elseif ($isFavoris === false) {
      $favoris = "
      <p>Ce morceau n'est pas dans vos favoris.</p>
      <form action=" . Router::getAddFavoris($trackId) . " method='post'>
        <input type='hidden' name='addTrackId' value=$trackId>
        <input type='hidden' name='genre' value=$genre>
        <button class='buttonYellow' type='submit'>Favoris</button>
      </form>";
    }
    include("pages/Song.php");
  }

  function getStringDate($dateStr) {
    $extractionDate = explode("T", $dateStr)[0];
    $splitDate = explode("-", $extractionDate);
    return $splitDate[2] . "/" . $splitDate[1] . "/" . $splitDate[0];
  }

  function makeListFavoris(ListSongItem $listItem) {
    $data = $listItem->getListItem();
    $list = "";
    foreach ($data as $fav) {
      $list .= $this->getHTMLItem($fav);
    }
    include("pages/Favoris.php");
  }

  function getStrDuration(int $timeMillis) {
    $secondes = floor($timeMillis/1000);
    $minutes = floor($secondes/60);
    $secondes = ($minutes != 0 ? $secondes%($minutes*60) : $secondes);
    return $minutes . ":" . (strlen("" . $secondes)===1 ? "0". $secondes : $secondes);
  }

  function makeGraphPage(array $data) {
    $labels = "[";
    $values = "[";
    foreach ($data as $line) {
      $labels .= "\"". $line["type"] . "\",";
      $values .= $line["count"] . ",";
    }
    $labels .= "]";
    $values .= "]";
    include("pages/Graph.php");
  }

  function makeCreateUserPage() {
    include("pages/CreateUser.php");
  }

  function makeConnexionPage() {
    include("pages/Connexion.php");
  }

  public static function htmlesc($str) {
        return htmlspecialchars($str,
            /* on échappe guillemets _et_ apostrophes : */
            ENT_QUOTES
            /* les séquences UTF-8 invalides sont
            * remplacées par le caractère �
            * au lieu de renvoyer la chaîne vide…) */
            | ENT_SUBSTITUTE
            /* on utilise les entités HTML5 (en particulier &apos;) */
            | ENT_HTML5,
            'UTF-8');
    }
}

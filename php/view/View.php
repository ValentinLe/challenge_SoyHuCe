<?php

/* gere l'affichage */
class View {

  public $feedback;
  public $isConnected;

  function __construct($feedback, $isConnected) {
    $this->feedback = $feedback;
    $this->isConnected = $isConnected;
  }

  /* setter sur le fait que l'utilisateur soit connecte ou non (true, false) */
  function setConnexion($newState) {
    $this->isConnected = $newState;
  }

  /* setter sur le feedback a afficher */
  function setFeedback($feedback) {
    $this->feedback = "<p class='feedback'>$feedback</p>";
  }

  /* construit la page d'accueil */
  function makeIndexPage() {
    include("pages/Accueil.php");
  }

  /* construit la page d'erreur */
  function makeErrorPage() {
    include("pages/Error.php");
  }

  /* construit la page de recherche avec une liste de musique */
  function makeSearchPage(ListSongItem $listItem) {
    $listResults = "";
    foreach ($listItem->getListItem() as $item) {
      $listResults .= $this->getHTMLItem($item);
    }
    include("pages/Search.php");
  }

  /* renvoi la valeur associee a la cle ou null si la cle existe pas */
  function getIfExist($song, $key) {
    return (key_exists($key, $song) ? $song[$key] : null);
  }

  /* affichage d'un prix si il n'est pas null */
  function strPrice($price) {
    if ($price !== null) {
      $price .= " €";
    } else {
      $price = "Non renseigné";
    }
    return $price;
  }

  /* construit la page d'une musique avec ses informations */
  function makePageSong(SongItem $song, $isFavoris) {
    // donnees de la musique
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
    $extraitURL = $this->getIfExist($data, "previewUrl");
    $favoris = "";

    if ($this->isConnected === true) {
      // gestion du button pour ajouter/suppr favoris
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
    } else {
      $favoris = "<p>Vous devez vous <a href=". Router::getConnexionPath() . ">connecter</a>
      pour accéder à l'ajout ou retrait de musiques en favoris.</p>";
    }
    include("pages/Song.php");
  }

  /*
    transform une date sous forme de string en date française
    ex: 2016-09-26T07:00:00Z => 26/09/2016
  */
  function getStringDate($dateStr) {
    if ($dateStr === null) {
      return "";
    }
    $extractionDate = explode("T", $dateStr)[0];
    $splitDate = explode("-", $extractionDate);
    return $splitDate[2] . "/" . $splitDate[1] . "/" . $splitDate[0];
  }

  /* rendu d'une musique dans une liste */
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

  /* construit la liste des favoris */
  function makeListFavoris(ListSongItem $listItem) {
    $data = $listItem->getListItem();
    $list = "";
    foreach ($data as $fav) {
      $list .= $this->getHTMLItem($fav);
    }
    include("pages/Favoris.php");
  }

  /* affiche la duree en millisecondes à minutes:scondes */
  function getStrDuration($timeMillis) {
    if ($timeMillis === null) {
      return "";
    }
    $secondes = floor($timeMillis/1000);
    $minutes = floor($secondes/60);
    $secondes = ($minutes != 0 ? $secondes%($minutes*60) : $secondes);
    return $minutes . ":" . (strlen("" . $secondes)===1 ? "0". $secondes : $secondes);
  }

  /* construit la page du graphique */
  function makeGraphPage(array $data) {
    // ajout des donnes pour chartjs
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

  /* construit la page sur la creation d'un utilisateur */
  function makeCreateUserPage() {
    include("pages/CreateUser.php");
  }

  /* construit la page de connexion */
  function makeConnexionPage() {
    include("pages/Connexion.php");
  }

  /* echape les caracteres invalides */
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

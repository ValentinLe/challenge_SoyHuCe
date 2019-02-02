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
      "<span class='time'>" . $item["trackTimeMillis"] . "</span>" .
      "<span class='trackName'>" . $item["trackName"] . "</span>" .
      "<span class='artistName'>" . $item["artistName"] . "</span>" .
      "<div class='zoneAudio'><audio controls src=" . $item["previewUrl"] . "></audio></div>" .
      "<button>Voir page</button>" .
    "</div>";
  }
}

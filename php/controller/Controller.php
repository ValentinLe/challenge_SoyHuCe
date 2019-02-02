<?php

class Controller {

  private $view;

  function __construct(View $view) {
    $this->view = $view;
  }

  function toIndexPage() {
    $this->view->makeIndexPage();
  }

  function toErrorPage() {
    $this->view->makeErrorPage();
  }

  function toSearchPage($search) {
    $search = str_replace(" ", "+", $search);
    $url = "https://itunes.apple.com/search?term=" . $this->htmlesc($search) . "&limit=20&entity=song";
    $contents = file_get_contents($url);
    if($contents !== false){
      $this->view->makeSearchPage($search, json_decode($contents, true));
    }
  }

  function toPageSong($songId) {
    $url = "https://itunes.apple.com/lookup?id=$songId";
    $contents = file_get_contents($url);
    if($contents !== false){
      $this->view->makePageSong(json_decode($contents, true)["results"][0]);
    }
  }

  function htmlesc($str) {
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

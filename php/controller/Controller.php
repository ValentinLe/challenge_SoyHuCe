<?php

require_once("model/ListItem.php");
require_once("model/ListSongItem.php");

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
    $jsonResult = RequestSearchAPI::getSearchWith($search, 20);
    $this->view->makeSearchPage(new ListSongItem($jsonResult["results"]));
  }

  function toPageSong($songId) {
    $jsonResult = RequestSearchAPI::getSearchWithId($songId);
    $this->view->makePageSong(new SongItem($jsonResult));
  }

  function toGraphPage() {
    $this->view->makeGraphPage();
  }

  function toListFavoris() {
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $data = $db->readAll();
    $this->view->makeListFavoris(new ListSongItem($data));
  }

  function addFavoris($trackId, $genre) {
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $db->addFavoris($trackId, $genre);
  }

  function toConnexionPage() {
    $this->view->makeConnexionPage();
  }

  function createUser($login, $password) {
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $db->createUser($login, $password);
  }

}

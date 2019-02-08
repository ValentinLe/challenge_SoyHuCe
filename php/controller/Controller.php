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
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $res = $db->getStats();
    $this->view->makeGraphPage($res);
  }

  function toListFavoris() {
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $data = $db->readAll();
    $ids = $this->createStringID($data);
    $jsonResult = RequestSearchAPI::getSearchWithIds($ids);
    $this->view->makeListFavoris(new ListSongItem($jsonResult));
  }

  function createStringID(array $list) {
    $res = "";
    foreach ($list as $fav) {
      $res .= $fav[DatabaseFavoris::COL_FAV_TRACKID] . ",";
    }
    return $res;
  }

  function addFavoris($trackId, $type) {
    include("db/config.php");
    $db = new DatabaseFavoris($pg);
    $db->addFavoris($trackId, $type);
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

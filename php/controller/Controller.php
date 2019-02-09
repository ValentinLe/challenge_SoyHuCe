<?php

require_once("model/ListItem.php");
require_once("model/ListSongItem.php");

class Controller {

  private $view;
  private $db;

  function __construct(View $view, DatabaseFavoris $db) {
    $this->view = $view;
    $this->db = $db;
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
    $isFavoris = $this->db->infavoris($songId);
    $this->view->makePageSong(new SongItem($jsonResult), $isFavoris);
  }

  function toGraphPage() {
    $res = $this->db->getStats();
    $this->view->makeGraphPage($res);
  }

  function toListFavoris() {
    $data = $this->db->readAll();
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
    $this->db->addFavoris($trackId, $type);
  }

  function removeFavoris($trackId) {
    $this->db->removeFavoris($trackId);
  }

  function toCreateUserPage() {
    $this->view->makeCreateUserPage();
  }

  function createUser($login, $password) {
    $this->db->createUser($login, password_hash($password, PASSWORD_BCRYPT));
  }

  function toConnexionPage() {
    $this->view->makeConnexionPage();
  }

  function connect($login, $password) {
    $user = $this->db->getUser($login);
    if ($user !== false && !password_verify($password, substr($user["password"], 0, 60))) {
      $user = false;
    }
    return $user;
  }

}

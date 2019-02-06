<?php

require_once("controller/Controller.php");
require_once("view/View.php");
require_once("model/RequestSearchAPI.php");
require_once("db/DatabaseFavoris.php");

class Router {

  function main() {
    session_start();

    $view = new View($_SESSION["feedback"]);
    $controller = new Controller($view);

    $_SESSION["feedback"] = "";
    $_SESSION["search"] = "";

    if (key_exists("search", $_POST)) {
      $this->POSTredirect($this->getSearchPath($_POST["search"]), $_SESSION["feedback"]);
    } elseif (key_exists("id", $_POST)) {
      $this->POSTredirect($this->getSongPath($_POST["id"]), $_SESSION["feedback"]);
    }
    if (key_exists("trackId", $_POST) && key_exists("trackName", $_POST) && key_exists("genre", $_POST)) {
      $controller->addFavoris($_POST["trackId"], $_POST["trackName"], $_POST["genre"]);
      $this->POSTredirect($this->getSongPath($_POST["trackId"]), "Ajouté aux favoris.");
    }

    if (key_exists("search", $_GET)) {
      $_SESSION["search"] = $_GET["search"];
      $controller->toSearchPage($_GET["search"]);
    } elseif (key_exists("graph", $_GET)) {
      $controller->toGraphPage();
    } elseif (key_exists("favoris", $_GET)) {
      $controller->toListFavoris();
    } elseif (key_exists("id", $_GET)) {
      $controller->toPageSong($_GET["id"], true);
    } else {
      $controller->toIndexPage();
    }
  }

  function POSTredirect($url, $feedback) {
    $_SESSION['feedback'] = $feedback;
    header("Location: " . $url, true, 303);
  }

  static function getIndexPath() {
    return "index.php";
  }

  static function getSearchPath($search) {
    return "index.php?search=$search";
  }

  static function getSongPath($id) {
    return "index.php?id=$id";
  }

  static function getGraphPath() {
    return "index.php?graph";
  }

  static function getAddFavoris($id) {
    return "index.php?fav=$id";
  }

  static function getFavorisPath() {
    return "index.php?favoris";
  }
}

<?php

require_once("controller/Controller.php");
require_once("view/View.php");
require_once("model/RequestSearchAPI.php");
require_once("db/DatabaseFavoris.php");

class Router {

  function main() {
    session_start();

    if (!key_exists("feedback", $_SESSION)) {
      $_SESSION["feedback"] = "";
    }

    include("db/config.php");
    $view = new View($_SESSION["feedback"]);
    $controller = new Controller($view, new DatabaseFavoris($pg));

    if (key_exists("login", $_POST)) {
      $_SESSION["login"] = $_POST["login"];
      $_SESSION["password"] = $_POST["password"];
      $controller->createUser($_POST["login"], $_POST["password"]);
    }

    $_SESSION["feedback"] = "";
    $_SESSION["search"] = "";

    if (key_exists("search", $_POST)) {
      $this->POSTredirect($this->getSearchPath($_POST["search"]), "");
    } elseif (key_exists("id", $_POST)) {
      $this->POSTredirect($this->getSongPath($_POST["id"]), "");
    }
    if (key_exists("trackId", $_POST) && key_exists("genre", $_POST)) {
      $controller->addFavoris($_POST["trackId"], $_POST["genre"]);
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
    } elseif (key_exists("create", $_GET)) {
      $controller->toConnexionPage();
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

  static function getConnexionPath() {
    return "index.php?create";
  }
}

<?php

require_once("controller/Controller.php");
require_once("view/View.php");
require_once("model/RequestSearchAPI.php");

class Router {

  function main() {
    session_start();
    if (!key_exists("feedback", $_SESSION)) {
      $_SESSION["feedback"] = "";
    }
    if (!key_exists("search", $_SESSION)) {
      $_SESSION["search"] = "";
    }

    $view = new View($_SESSION["feedback"]);
    $controller = new Controller($view);

    if (key_exists("search", $_POST)) {
      $_SESSION["search"] = $_POST["search"];
      $this->POSTredirect($this->getSearchPath($_POST["search"]), $_SESSION["feedback"]);
    } elseif (key_exists("id", $_POST)) {
      $this->POSTredirect($this->getSongPath($_POST["id"]), $_SESSION["feedback"]);
    }

    if (key_exists("search", $_GET)) {
      $controller->toSearchPage($_GET["search"]);
    } elseif (key_exists("graph", $_GET)) {
      $controller->toGraphPage();
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

}

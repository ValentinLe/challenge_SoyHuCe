<?php

require_once("controller/Controller.php");
require_once("view/View.php");
require_once("model/RequestSearchAPI.php");

class Router {

  function main() {
    $view = new View();
    $controller = new Controller($view);

    if (key_exists("search", $_POST)) {
      $controller->toSearchPage($_POST["search"]);
    } elseif (key_exists("search", $_GET)) {
      $controller->toSearchPage($_GET["search"]);
    } elseif (key_exists("graph", $_GET)) {
      $controller->toGraphPage();
    } elseif (key_exists("id", $_POST)) {
      $controller->toPageSong($_POST["id"], true);
    } else {
      $controller->toIndexPage();
    }
  }

  static function getIndexPage() {
    return "index.php";
  }

  static function getSearchPage() {
    return "index.php?search";
  }

  static function getSongPath() {
    return "index.php?song";
  }

  static function getGraphPath() {
    return "index.php?graph";
  }

}

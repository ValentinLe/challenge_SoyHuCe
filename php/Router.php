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

}

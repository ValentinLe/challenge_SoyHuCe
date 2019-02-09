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

    $isConnected = false;

    include("db/config.php");
    $view = new View($_SESSION["feedback"], false);
    $db = new DatabaseFavoris($pg, -1);
    $controller = new Controller($view, $db);

    if (key_exists("login", $_POST)) {
      $user = $controller->connect($_POST["login"], $_POST["password"]);
      if ($user !== false && key_exists("login", $user)) {
        $_SESSION["userid"] = $user["userid"];
        $_SESSION["login"] = $user["login"];
        $view->setConnexion(true);
        $isConnected = true;
      } else {
        $this->POSTredirect($this->getConnexionPath(), "Le login ou mot de passe est incorrect");
      }
    }

    if (key_exists("login", $_SESSION)) {
      $db->setUserId($_SESSION["userid"]);
      $view->setConnexion(true);
      $isConnected = true;
    }

    if (key_exists("newLogin", $_POST)) {
      $_SESSION["login"] = $_POST["newLogin"];
      $controller->createUser($_POST["newLogin"], $_POST["newPassword"]);
    }

    if (key_exists("search", $_POST)) {
      $this->POSTredirect($this->getSearchPath($_POST["search"]), "");
    } elseif (key_exists("id", $_POST)) {
      $this->POSTredirect($this->getSongPath($_POST["id"]), "");
    }
    if (key_exists("trackId", $_POST) && key_exists("genre", $_POST)) {
      $controller->addFavoris($_POST["trackId"], $_POST["genre"]);
      $this->POSTredirect($this->getSongPath($_POST["trackId"]), "Ajouté aux favoris.");
    }

    // Gestion du GET
    if (key_exists("search", $_GET)) {
      $_SESSION["search"] = $_GET["search"];
      $controller->toSearchPage($_GET["search"]);
    } elseif (key_exists("graph", $_GET)) {
      if ($isConnected === true) {
        $controller->toGraphPage();
      } else {
        $controller->toConnexionPage();
      }
    } elseif (key_exists("favoris", $_GET)) {
      if ($isConnected === true) {
        $controller->toListFavoris();
      } else {
        $controller->toConnexionPage();
      }
    } elseif (key_exists("id", $_GET)) {
      $controller->toPageSong($_GET["id"], true);
    } elseif (key_exists("create", $_GET)) {
      $controller->toCreateUserPage();
    } elseif (key_exists("connexion", $_GET)) {
      $controller->toConnexionPage();
    } elseif (key_exists("deconnexion", $_GET)) {
      unset($_SESSION["login"]);
      $this->redirect($this->getIndexPath());
    } else {
      $controller->toIndexPage();
    }
    
  } // --------------------- FIN MAIN ---------------------


  function POSTredirect($url, $feedback) {
    $_SESSION['feedback'] = $feedback;
    header("Location: " . $url, true, 303);
  }

  function redirect($url) {
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

  static function getCreateUserPath() {
    return "index.php?create";
  }

  static function getConnexionPath() {
    return "index.php?connexion";
  }

  static function getDeconnexionPath() {
    return "index.php?deconnexion";
  }
}

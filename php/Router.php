<?php

require_once("controller/Controller.php");
require_once("view/View.php");
require_once("model/RequestSearchAPI.php");
require_once("db/DatabaseFavoris.php");

/* redirige vers selon les donnees vers la bonne methode du controller */
class Router {

  public $view;
  public $db;
  public $controller;
  public $isConnected;

  function __construct() {
    include("db/config.php"); // donnees des config de la bdd
    $this->view = new View("", false);
    $this->db = new DatabaseFavoris($pg, -1);
    $this->controller = new Controller($this->view, $this->db);
    $this->isConnected = false;
  }

  function main() {
    session_start();

    $feedback = (key_exists("feedback", $_SESSION) ? $_SESSION["feedback"] : "");
    if ($feedback !== "") {
      $this->view->setFeedback($feedback);
      unset($_SESSION["feedback"]);
    }

    // test si l'utilisateur est connecte
    if (key_exists("login", $_SESSION)) {
      $this->db->setUserId($_SESSION["userid"]);
      $this->view->setConnexion(true);
      $this->isConnected = true;
    }

    $this->gestionPOST();

    $this->gestionGET();

  } // --------------------- FIN MAIN ---------------------

  function gestionPOST() {
    if (key_exists("login", $_POST)) {
      // envoi de la connexion d'un utilisateur
      $user = $this->controller->connect($_POST["login"], $_POST["password"]);
      if ($user !== false && key_exists("login", $user)) {
        $_SESSION["userid"] = $user["userid"];
        $_SESSION["login"] = $user["login"];
        $this->view->setConnexion(true);
        $this->isConnected = true;
      } else {
        $this->POSTredirect($this->getConnexionPath(), "Le login ou mot de passe est incorrect.");
      }
    } elseif (key_exists("newLogin", $_POST)) {
      // création d'un utilisateur
      if (!$this->controller->userExists($_POST["newLogin"])) {
        // si le login n'existe pas
        $this->isConnected = true;
        $this->view->setConnexion(true);
        $userId = $this->controller->createUser($_POST["newLogin"], $_POST["newPassword"]);
        $this->db->setUserId($userId);
        $_SESSION["login"] = $_POST["newLogin"];
        $_SESSION["userid"] = $userId;
      } else {
        $this->POSTredirect($this->getCreateUserPath(), "Un utilisateur possède déjà ce login.");
      }
    } else if (key_exists("search", $_POST)) {
      // recuperation de la recherche et passage en GET
      $this->POSTredirect($this->getSearchPath($_POST["search"]), "");
    } elseif (key_exists("id", $_POST)) {
      // recuperation de la musique et passage en sur la page en GET
      $this->POSTredirect($this->getSongPath($_POST["id"]), "");
    } else if (key_exists("addTrackId", $_POST) && key_exists("genre", $_POST)) {
      // ajout d'une musique en favoris
      $this->controller->addFavoris($_POST["addTrackId"], $_POST["genre"]);
      $this->POSTredirect($this->getSongPath($_POST["addTrackId"]), "Ajouté aux favoris.");
    } else if (key_exists("delTrackId", $_POST)) {
      // retrait d'une musique des favoris
      $this->controller->removeFavoris($_POST["delTrackId"]);
      $this->POSTredirect($this->getSongPath($_POST["delTrackId"]), "Supprimer des favoris.");
    }
  }

  function gestionGET() {
    if (key_exists("search", $_GET)) {
      // recherche d'une musique
      $_SESSION["search"] = $_GET["search"];
      $this->controller->toSearchPage($_GET["search"]);
    } elseif (key_exists("graph", $_GET)) {
      // page du graphique renvoi sur la page de connexion si l'utilisateur n'est
      // pas connecte
      if ($this->isConnected === true) {
        $this->controller->toGraphPage();
      } else {
        $this->controller->toConnexionPage();
      }
    } elseif (key_exists("favoris", $_GET)) {
      // page de la liste des favoris renvoi sur la page de connexion si
      // l'utilisateur n'est pas connecte
      if ($this->isConnected === true) {
        $this->controller->toListFavoris();
      } else {
        $this->controller->toConnexionPage();
      }
    } elseif (key_exists("id", $_GET)) {
      // dirige sur la page de la musique
      $this->controller->toPageSong($_GET["id"], true);
    } elseif (key_exists("create", $_GET)) {
      // page de creation d'un compte
      $this->controller->toCreateUserPage();
    } elseif (key_exists("connexion", $_GET)) {
      // page de connexion
      $this->controller->toConnexionPage();
    } elseif (key_exists("deconnexion", $_GET)) {
      // deconnecte l'utilisateur
      unset($_SESSION["login"]);
      $this->redirect($this->getIndexPath());
    } else {
      // page d'accueil
      $this->controller->toIndexPage();
    }
  }

  /* redirige avec un feedback */
  function POSTredirect($url, $feedback) {
    $_SESSION['feedback'] = $feedback;
    header("Location: " . $url, true, 303);
  }

  /* simple redirection */
  function redirect($url) {
    header("Location: " . $url, true, 303);
  }

  /* Getters de path */

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

  static function getSupprFavoris($id) {
    return "index.php?del=$id";
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

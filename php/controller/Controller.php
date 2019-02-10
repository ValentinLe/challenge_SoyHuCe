<?php

require_once("model/ListSongItem.php");

/* s'occupe des déscisions d'affichage et requetes */
class Controller {

  private $view;
  private $db;

  function __construct(View $view, DatabaseFavoris $db) {
    $this->view = $view;
    $this->db = $db;
  }

  /* renvoi sur l'affichage de la page d'accueil */
  function toIndexPage() {
    $this->view->makeIndexPage();
  }

  /* renvoi sur l'affichage de la page d'erreur */
  function toErrorPage() {
    $this->view->makeErrorPage();
  }

  /* fait la requete et renvoi sur l'affichage des resultats de la recherche */
  function toSearchPage($search) {
    $list;
    // pour eviter de lancer la recherche alors qu'il n'y a rien
    if ($search !== "") {
      $list = RequestSearchAPI::getSearchWith($search, 40)["results"];
    } else {
      $list = array();
    }
    $this->view->makeSearchPage(new ListSongItem($list));
  }

  /*
    renvoi sur la page de la musique de l'id voulu ou sur la page d'erreur si
    l'id n'existe pas
  */
  function toPageSong($songId) {
    $jsonResult = RequestSearchAPI::getSearchWithId($songId);
    if ($jsonResult !== null) {
      $isFavoris = $this->db->infavoris($songId);
      $this->view->makePageSong(new SongItem($jsonResult), $isFavoris);
    } else {
      $this->toErrorPage();
    }
  }

  /* renvoi sur la page les stats recupere de l'utilisateur dans la bdd */
  function toGraphPage() {
    $res = $this->db->getStats();
    $this->view->makeGraphPage($res);
  }

  /*
    fait la requete a la base de donnee pour recuperer les favoris de l'utilisateur
    et renvoi sur la liste de ses favoris
   */
  function toListFavoris() {
    $data = $this->db->readAll();
    $ids = $this->createStringID($data);
    $jsonResult = RequestSearchAPI::getSearchWithIds($ids);
    $this->view->makeListFavoris(new ListSongItem($jsonResult));
  }

  /*
    transforme une liste d'id en string separee par une virgule pour la requete API
    ex: ["456", "1453", "2365"] => "456,1453,2365,"
   */
  function createStringID(array $listId) {
    $res = "";
    foreach ($listId as $fav) {
      $res .= $fav[DatabaseFavoris::COL_FAV_TRACKID] . ",";
    }
    return $res;
  }

  /* ajoute une musique en favoris pour l'utilisateur dans la bdd */
  function addFavoris($trackId, $type) {
    $this->db->addFavoris($trackId, $type);
  }

  /* supprime une musique des favoris pour l'utilisateur dans la bdd */
  function removeFavoris($trackId) {
    $this->db->removeFavoris($trackId);
  }

  /* renvoi sur la page de creation d'un compte */
  function toCreateUserPage() {
    $this->view->makeCreateUserPage();
  }

  /* cree un utilisateur dans la bdd */
  function createUser($login, $password) {
    $this->db->createUser($login, password_hash($password, PASSWORD_BCRYPT));
  }

  /* renvoi sur la page de connexion */
  function toConnexionPage() {
    $this->view->makeConnexionPage();
  }

  /* renvoi l'utilisateur si le login et le mot de passe sont correct ou false sinon */
  function connect($login, $password) {
    $user = $this->db->getUser($login);
    if ($user !== false && !password_verify($password, substr($user["password"], 0, 60))) {
      $user = false;
    }
    return $user;
  }

}

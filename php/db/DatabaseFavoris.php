<?php

/* gere les requete SQL sur la base de donnees */
class DatabaseFavoris {

  const COL_USER_ID = "userid";
  const COL_USER_LOGIN = "login";
  const COL_USER_PASSWORD = "password";

  const COL_FAV_USERID = "userid";
  const COL_FAV_TRACKID = "trackid";
  const COL_FAV_TYPE = "type";

  private $db;
  private $userId;

  function __construct($PDO_db, $userId) {
    $this->db = $PDO_db;
    $this->userId = $userId;
  }

  function userConnected() {
    return $this->userid >= 0;
  }

  /* setter sur l'id de l'utilisateur */
  function setUserId($userId) {
    $this->userId = $userId;
  }

  /* lit tous les favoris */
  function readAll() {
    $query = $this->db->query("SELECT * FROM Favoris WHERE userId='$this->userId';");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* recupere la musique de l'utilisateur dans les favoris dont l'id de la musique est passe */
  function read($trackId) {
    $query = $this->db->query("SELECT * FROM Favoris WHERE userId=$this->userId AND trackid=$trackId;");
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  /* ajoute à l'utilisateur l'id d'une musique et son genre dans les favoris */
  function addFavoris($trackId, $type) {
    $sql = 'INSERT INTO Favoris(userid,trackid,type) VALUES(:userid,:trackid,:type)';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':userid', $this->userId);
    $stmt->bindValue(':trackid', $trackId);
    $stmt->bindValue(':type', $type);
    $stmt->execute();
  }

  /* supprime le favoris de l'utilisateur de l'id donne */
  function removeFavoris($trackId) {
    $sql = 'DELETE FROM Favoris WHERE userid = :userid AND trackid = :trackid';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':userid', $this->userId);
    $stmt->bindValue(':trackid', $trackId);
    $stmt->execute();
  }

  /* creer un utilisateur avec le login et le mot de passe donnees */
  function createUser($login, $password) {
    $sql = 'INSERT INTO Utilisateur(login,password) VALUES(:login,:password)';
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
  }

  /* recupere la liste (genre: nb occurence) des favoris de l'utilisateur */
  function getStats() {
    $query = $this->db->query("SELECT type, count(type) FROM Favoris WHERE userid=$this->userId GROUP BY type;");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  /* recupere l'utilisateur dans la bdd ou false si il n'existe pas */
  function getUser($login) {
    $query = $this->db->query("SELECT * FROM Utilisateur WHERE login='$login'");
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  /* renvoi true si la musique n'est pas deja dans les favoris de l'utilisateur  */
  function inFavoris($trackId) {
    $query = $this->db->query("SELECT * FROM Favoris WHERE userid='$this->userId' AND trackid=$trackId");
    return $query->fetch(PDO::FETCH_ASSOC) !== false;
  }

}

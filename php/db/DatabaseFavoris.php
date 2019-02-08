<?php

class DatabaseFavoris {

  const COL_USER_ID = "userid";
  const COL_USER_LOGIN = "login";
  const COL_USER_PASSWORD = "password";

  const COL_FAV_USERID = "userid";
  const COL_FAV_TRACKID = "trackid";
  const COL_FAV_TYPE = "type";

  private $db;
  private $userId;

  function __construct($PDO_db) {
    $this->db = $PDO_db;
    $this->userId = 1;
  }

  function readAll() {
    $query = $this->db->query("SELECT * FROM Favoris WHERE userId=$this->userId;");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  function read($trackId) {
    $query = $this->db->query("SELECT * FROM Favoris WHERE userId=$this->userId AND trackid=$trackId;");
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  function addFavoris($trackId, $type) {
    $sql = 'INSERT INTO Favoris(userid,trackid,type) VALUES(:userid,:trackid,:type)';
    $stmt = $this->db->prepare($sql);

    // pass values to the statement
    $stmt->bindValue(':userid', $this->userId);
    $stmt->bindValue(':trackid', $trackId);
    $stmt->bindValue(':type', $type);

    // execute the insert statement
    $stmt->execute();
  }

  function createUser($login, $password) {
    $sql = 'INSERT INTO Utilisateur(login,password) VALUES(:login,:password)';
    $stmt = $this->db->prepare($sql);

    // pass values to the statement
    $stmt->bindValue(':login', $login);
    $stmt->bindValue(':password', $password);

    // execute the insert statement
    $stmt->execute();
  }
}

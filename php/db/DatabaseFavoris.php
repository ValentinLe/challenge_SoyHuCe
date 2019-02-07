<?php

class DatabaseFavoris {

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

  function insert($trackId, $genre) {
    $sql = 'INSERT INTO Favoris(userid,trackid,genre) VALUES(:userid,:trackid,:genre)';
    var_dump($trackId . " " . $genre);
    $stmt = $this->db->prepare($sql);

    // pass values to the statement
    $stmt->bindValue(':userid', $this->userId);
    $stmt->bindValue(':trackid', $trackId);
    $stmt->bindValue(':genre', $genre);

    // execute the insert statement
    $stmt->execute();
  }
}

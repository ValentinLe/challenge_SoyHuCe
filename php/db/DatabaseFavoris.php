<?php

class DatabaseFavoris {

  private $db;

  function __construct($PDO_db) {
    $this->db = $PDO_db;
  }

  function getAll() {
    $query = $this->db->query("SELECT * FROM Favoris;");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  function getFavoris($trackId) {
    $query = $this->db->query("SELECT * FROM Favoris WHERE trackid=$trackId;");
    return $query->fetch();
  }

  function insert($trackId, $genre) {
    $sql = 'INSERT INTO Favoris(trackid,genre) VALUES(:trackid,:genre)';
    $stmt = $this->db->prepare($sql);

    // pass values to the statement
    $stmt->bindValue(':trackid', $trackId);
    $stmt->bindValue(':genre', $genre);

    // execute the insert statement
    $stmt->execute();
  }
}

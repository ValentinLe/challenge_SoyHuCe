<?php

class DatabaseFavoris {

  private $db;

  function __construct($PDO_db) {
    $this->db = $PDO_db;
  }

  function readAll() {
    $query = $this->db->query("SELECT * FROM Favoris;");
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  function read($trackId) {
    $query = $this->db->query("SELECT * FROM Favoris WHERE trackid=$trackId;");
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  function insert($trackId, $titre, $genre) {
    $sql = 'INSERT INTO Favoris(trackid,titre,genre) VALUES(:trackid,:titre,:genre)';
    $stmt = $this->db->prepare($sql);

    // pass values to the statement
    $stmt->bindValue(':trackid', $trackId);
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':genre', $genre);

    // execute the insert statement
    $stmt->execute();
  }
}

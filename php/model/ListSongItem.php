<?php

require_once("SongItem.php");

class ListSongItem {

  private $listItem;

  function __construct(array $jsonListSong) {
    $this->listItem = $this->transformToListSongItem($jsonListSong);
  }

  /* transform un Json avec liste de musique en liste de musique avec leur donnees */
  function transformToListSongItem($listSong) {
    $listItem = array();
    foreach ($listSong as $song) {
      $listItem[] = new SongItem($song);
    }
    return $listItem;
  }

  /* getter sur la liste de musique */
  function getListItem() {
    return $this->listItem;
  }

  /* test si la musique donnee est presente dans la liste */
  function contains(SongItem $item) {
    foreach ($this->listItem as $item) {
      if ($item->equals($item)) {
        return true;
      }
    }
    return false;
  }

  /* retourne la taille de la lsite */
  function size() {
    return count($this->listItem);
  }
}

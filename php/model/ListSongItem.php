<?php

require_once("Item.php");
require_once("SongItem.php");

class ListSongItem implements ListItem {

  private $listItem;

  function __construct(array $listSong) {
    $this->listItem = $this->transformToListSongItem($listSong);
  }

  function transformToListSongItem($listSong) {
    $listItem = array();
    foreach ($listSong as $song) {
      $listItem[] = new SongItem($song);
    }
    return $listItem;
  }

  function getListItem() {
    return $this->listItem;
  }

  function contains(Item $item) {
    foreach ($this->listItem as $item) {
      if ($item->equals($item)) {
        return true;
      }
    }
    return false;
  }

  function size() {
    return count($this->listItem);
  }
}

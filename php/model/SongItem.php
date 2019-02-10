<?php

class SongItem {

  private $data;

  function __construct(array $data) {
    $this->data = $data;
  }

  /* getter sur les donnes de la musique */
  function getData() {
    return $this->data;
  }

  /* getter sur une donnee particuliere de la musique */
  function getValueOf($key) {
    if ($this->keyExists($key)) {
      return $this->data[$key];
    } else {
      return null;
    }
  }

  /* test si la cle est dans les donnees de la musique */
  function keyExists($key) {
    return key_exists($key, $this->data);
  }

  /* test si 2 musique sont égales, elle ont le meme ID de musique */
  function equals(SongItem $otherItem) {
    return $this->getValueOf("trackId") === $otherItem->getValueOf("trackId");
  }
}

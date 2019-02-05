<?php

class SongItem implements Item {

  private $data;

  function __construct(array $data) {
    $this->data = $data;
  }

  function getData() {
    return $this->data;
  }

  function getValueOf($key) {
    if ($this->keyExists($key)) {
      return $this->data[$key];
    } else {
      return null;
    }
  }

  function keyExists($key) {
    return key_exists($key, $this->data);
  }

  function equals(Item $otherItem) {
    return $this->getValueOf("trackId") === $otherItem->getValueOf("trackId");
  }
}

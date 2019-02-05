<?php

interface Item {
  function getData();
  function getValueOf($key);
  function keyExists($key);
  function equals(Item $otherItem);
}

<?php

interface ListItem {
  function getListItem();
  function contains(Item $item);
  function size();
}

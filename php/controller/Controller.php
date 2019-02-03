<?php

class Controller {

  private $view;

  function __construct(View $view) {
    $this->view = $view;
  }

  function toIndexPage() {
    $this->view->makeIndexPage();
  }

  function toErrorPage() {
    $this->view->makeErrorPage();
  }

  function toSearchPage($search) {
    $jsonResult = RequestSearchAPI::getSearchWith($search, 20);
    $this->view->makeSearchPage($search, $jsonResult);
  }

  function toPageSong($songId) {
    $jsonResult = RequestSearchAPI::getSearchWithId($songId);
    $this->view->makePageSong($jsonResult);
  }

  function toGraphPage() {
    $this->view->makeGraphPage();
  }
}

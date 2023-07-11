<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Application
{
  private $controller;

  public function __construct()
  {
    $url = isset($_GET['url']) ? explode('/', $_GET['url']) : array('home');

    if ($url[0] == 'home') {
      $loadName = 'HomeController';
    } else {
      $loadName = ucfirst(strtolower($url[0])) . 'Controller';
    }


    $filePath = 'app/Controllers/' . $loadName . '.php';
    if (file_exists($filePath)) {
      require_once $filePath;
      $this->controller = new $loadName();
      $this->controller->index(); // Adicionado
    } else {
      include('app/pages/404.php');
      die();
    }
  }
}

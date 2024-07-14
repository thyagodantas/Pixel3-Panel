<?php

session_start();
date_default_timezone_set('America/Recife');

$autoload = function ($class) {
    $class_file = str_replace('\\', '/', $class) . '.php';
    if (file_exists('app/classes/' . $class_file)) {
        include 'app/classes/' . $class_file;
    } elseif (file_exists('app/Models/' . $class_file)) {
        include 'app/Models/' . $class_file;
    }
};

spl_autoload_register($autoload);

define('INCLUDE_PATH', 'http://painel.altekweb.com.br/');
define('INCLUDE_PATH_STATIC', 'http://painel.altekweb.com.br/app/');
define('INCLUDE_PATH_STYLE', 'http://painel.altekweb.com.br/app/pages/estilos/');

//DB
define('HOST', 'localhost');
define('DATABASE', 'altekweb');
define('USER', 'root');
define('PASSWORD', '2003');

//Menu Active

function selecionadoMenu($menu)
{
    $url = isset($_GET['url']) ? explode('/', $_GET['url']) : array();
    if (isset($url[0]) && $url[0] == $menu) {
        echo 'class="menu-active"';
    }
};

function verificaPermissao($cargo)
{
    if ($_SESSION['cargo'] == $cargo) {
        return;
    } else {
        echo 'style="display:none;"';
    }
};

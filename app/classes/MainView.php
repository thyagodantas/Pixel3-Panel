<?php

class MainView
{

    public static function render($filename)
    {
        include('./app/pages/'.$filename.'.php');
    }

}

?>
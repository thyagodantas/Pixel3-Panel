<?php

class UsuariosModel

{

    public static function countUsuarios()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
        return $count;
    }
}

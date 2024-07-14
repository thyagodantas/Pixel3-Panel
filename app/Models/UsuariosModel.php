<?php

class UsuariosModel

{

    public static function emailExists($email)
    {
        $pdo = MySql::connect();
        $verificar = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $verificar->execute(array($email));

        if ($verificar->rowCount() == 1) {
            //Email existe
            return true;
        } else {
            //Email não existe
            return false;
        }
    }

    public static function listUsuarios($start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $usuarios = MySql::connect()->prepare("SELECT id, nome, email, ip_address, admin, createdAt, createdBy FROM usuarios ORDER BY admin");
        } else {
            $usuarios = MySql::connect()->prepare("SELECT id, nome, email, ip_address, admin, createdAt, createdBy FROM usuarios ORDER BY admin LIMIT $start,$end");
        }
        $usuarios->execute();
        $resultados = $usuarios->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function excluirUsuario($id)
    {
        $excluirUsuarios = MySql::connect()->prepare("DELETE FROM usuarios WHERE id = ?");
        $excluirUsuarios->bindValue(1, $id);
        $excluirUsuarios->execute();
    }

    public static function countUsuarios()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
        return $count;
    }
}

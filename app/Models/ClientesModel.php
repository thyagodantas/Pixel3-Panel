<?php


class ClientesModel
{

    public static function listClients($start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $cadastrados = MySql::connect()->prepare("SELECT nome, id, url FROM clientes");
        } else {
            $cadastrados = MySql::connect()->prepare("SELECT nome, id, url FROM clientes LIMIT $start,$end");
        }
        $cadastrados->execute();
        $resultados = $cadastrados->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function excluirCliente($id)
    {
        $excluirCliente = MySql::connect()->prepare("DELETE FROM clientes WHERE id = ?");
        $excluirCliente->bindValue(1, $id);
        $excluirCliente->execute();
    }


    public static function countClients()
    {

        $count = MySql::connect()->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
        return $count;
    }
}

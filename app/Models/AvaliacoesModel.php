<?php


class AvaliacoesModel
{

    public static function listAvaliacoes($start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $cadastrados = MySql::connect()->prepare("SELECT usuario, id, site FROM avaliacoes ORDER BY id DESC");
        } else {
            $cadastrados = MySql::connect()->prepare("SELECT usuario, id, site FROM avaliacoes ORDER BY id DESC LIMIT $start,$end");
        }
        $cadastrados->execute();
        $resultados = $cadastrados->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function excluirAvaliacoes($id)
    {
        $excluirCliente = MySql::connect()->prepare("DELETE FROM avaliacoes WHERE id = ?");
        $excluirCliente->bindValue(1, $id);
        $excluirCliente->execute();
    }


    public static function countAvaliacoes()
    {

        $count = MySql::connect()->query("SELECT COUNT(*) FROM avaliacoes")->fetchColumn();
        return $count;
    }
}

<?php


class PortifolioModel

{

    public static function listPortifolio($start = null, $end = null)
    {
        if ($start == null && $end == null) {
            $cadastrados = MySql::connect()->prepare("SELECT nome, id, categoria, imagem FROM portifolio");
        } else {
            $cadastrados = MySql::connect()->prepare("SELECT nome, id, categoria, imagem FROM portifolio LIMIT $start,$end");
        }
        $cadastrados->execute();
        $resultados = $cadastrados->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function excluirPortifolio($id)
    {
        $excluirPortifolio = MySql::connect()->prepare("DELETE FROM portifolio WHERE id = ?");
        $excluirPortifolio->bindValue(1, $id);
        $excluirPortifolio->execute();
    }



    public static function countPortifolio()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM portifolio")->fetchColumn();
        return $count;
    }
}

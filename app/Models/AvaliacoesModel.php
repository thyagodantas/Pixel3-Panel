<?php


class AvaliacoesModel
{


    public static function countAvaliacoes()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM avaliacoes")->fetchColumn();
        return $count;
    }
}

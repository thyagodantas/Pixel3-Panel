<?php


class PortifolioModel

{

    public static function countPortifolio()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM portifolio")->fetchColumn();
        return $count;
    }
}

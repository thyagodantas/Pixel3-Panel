<?php

class EmailsModel {

    public static function countEmails()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM contato")->fetchColumn();
        return $count;
    }







}

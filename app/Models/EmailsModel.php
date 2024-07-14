<?php

class EmailsModel
{

    public static function listEmails()
    {
        $emails = MySql::connect()->prepare("SELECT id, nome, email, telefone, categoria, empresa, mensagem FROM contato ORDER BY id DESC");
        $emails->execute();
        $resultados = $emails->fetchAll(\PDO::FETCH_ASSOC);

        return $resultados;
    }

    public static function excluirEmail($id)
    {
        $excluirEmail = MySql::connect()->prepare("DELETE FROM contato WHERE id = ?");
        $excluirEmail->bindValue(1, $id);
        $excluirEmail->execute();
    }

    public static function countEmails()
    {
        $count = MySql::connect()->query("SELECT COUNT(*) FROM contato")->fetchColumn();
        return $count;
    }
}

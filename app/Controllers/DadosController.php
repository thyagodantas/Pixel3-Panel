<?php


class DadosController
{


    public function index()
    {

        if (isset($_SESSION['login'])) {
            MainView::render('dados');


            if (isset($_POST['atualizar'])) {
                $nome = strip_tags($_POST['nome']);
                $email = $_POST['email'];
                $senha = $_POST['senha'];


                if ($senha != '') {
                    $pdo = MySql::connect();
                    $senha = Bcrypt::hash($senha);
                    $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
                    $atualizar->execute(array($nome, $email, $senha, $_SESSION['id']));
                    $_SESSION['nomeCompleto'] = $nome;

                    Utilidades::successAlertDashboard("Seus dados e senha foram atualizados com sucesso. ");
                    Utilidades::redirect(INCLUDE_PATH . 'dados');
                } else {
                    $pdo = MySql::connect();
                    $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
                    $atualizar->execute(array($nome, $email, $_SESSION['id']));
                    $_SESSION['nomeCompleto'] = $nome;

                    Utilidades::successAlertDashboard("Seus dados foram atualizados com sucesso. ");
                    Utilidades::redirect(INCLUDE_PATH . 'dados');
                }
            }
        } else {
            //Renderiza tela de login
            Utilidades::dangerAlert("Você não está logado.");
            Utilidades::redirect(INCLUDE_PATH);
        }
    }
}

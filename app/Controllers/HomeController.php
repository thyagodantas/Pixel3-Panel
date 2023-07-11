<?php


class HomeController
{


    public function index()
    {

        if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            Utilidades::redirect(INCLUDE_PATH);
        }

        if (isset($_SESSION['login'])) {
            MainView::render('home');
        } else {

            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $senha = $_POST['senha'];


                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Utilidades::dangerAlert("Email inválido");
                    Utilidades::redirect(INCLUDE_PATH);
                }

                $verifica = MySql::connect()->prepare("SELECT * FROM `usuarios` WHERE email = ?");
                $verifica->execute(array($email));

                if ($verifica->rowCount() == 0) {
                    //Não existe usuário
                    Utilidades::dangerAlert("Não existe usuário com este email.");
                    Utilidades::redirect(INCLUDE_PATH);
                } else {
                    $dados = $verifica->fetch();
                    $senhaBanco = $dados['senha'];

                    if (Bcrypt::check($senha, $senhaBanco)) {
                        //Usuário logado
                        $_SESSION['login'] = $dados['email'];
                        $_SESSION['id'] = $dados['id'];
                        $_SESSION['nome'] = explode(' ', $dados['nome'])[0];
                        $_SESSION['nomeCompleto'] = $dados['nome'];
                        $_SESSION['cargo'] = $dados['admin'];

                        Utilidades::successAlert("Logado com sucesso");
                        Utilidades::redirect(INCLUDE_PATH);
                    } else {
                        Utilidades::dangerAlert("Email ou senha incorretos.");
                        Utilidades::redirect(INCLUDE_PATH);
                    }
                }
            }
            MainView::render('login');
        }
    }
}

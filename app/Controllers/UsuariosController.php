<?php

class UsuariosController
{

    public function index()
    {
        if (isset($_SESSION['login'])) {
            if ($_SESSION['cargo'] == 1) {

                //Renderiza CMS
                MainView::render('usuarios');

                if (isset($_POST['excluir'])) {
                    if ($_SESSION['cargo'] == 1) {
                        $id = $_POST['id'];
                        UsuariosModel::excluirUsuario($id);
                        Utilidades::dangerAlertDashboard('Usuário excluído com sucesso!');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    } else {
                        Utilidades::dangerAlertDashboard('Você não tem permissão para excluir.');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    }
                }

                if (isset($_POST['atualizarUsuario'])) {
                    if ($_SESSION['cargo'] == 1) {
                        $id = $_POST['idUsuario'];
                        $nome = $_POST['nome'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $cargo = $_POST['tipo_usuario'];


                        if ($nome == '' || $email == '') {
                            Utilidades::dangerAlertDashboard("Você deixou algum campo vazio.");
                            Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                        } else if ($senha == '') {
                            $pdo = MySql::connect();
                            $atualizarUsuario = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, admin = ? WHERE id = ?");
                            $atualizarUsuario->execute(array($nome, $email, $cargo, $id));

                            Utilidades::successAlertDashboard("Dados do usuário atualizados com sucesso.");
                            Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                        } else {
                            $pdo = MySql::connect();
                            $senha = Bcrypt::hash($senha);
                            $atualizar = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
                            $atualizar->execute(array($nome, $email, $senha, $id));

                            Utilidades::successAlertDashboard("Dados e senha do usuário atualizados com sucesso.");
                            Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                        }
                    } else {
                        Utilidades::dangerAlertDashboard("Você não tem permissão.");
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    }
                }

                if (isset($_POST['editar'])) {
                    // Obtém o valor do ID a partir da variável $_POST['conteudo']
                    $id = $_POST['editarId'];

                    // Executa a consulta SQL para selecionar o registro com o ID desejado
                    $sql = MySql::connect()->prepare("SELECT * FROM usuarios WHERE id = ?");
                    $sql->execute(array($id));

                    // Exibe o conteúdo do registro na página
                    $row = $sql->fetch();

                    echo "<script>
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = 'none';
                                window.location.href='" . INCLUDE_PATH . "usuarios" . "'
                            }
                        }
                        span.onclick = function () {
                            modal.style.display = 'none';
                            window.location.href='" . INCLUDE_PATH . "usuarios" . "'
                        }
            
                        modal.classList.add('show');
            
            
                        conteudo.innerHTML = \"<form class='clientes-form' method='POST'>\" +
                        \"<input type='text' name='nome' id='nome' value='" . $row['nome'] . "'>\"+
                        \"<input type='text' name='email' id='email' value='" . $row['email'] . "'>\"+
                        \"<input type='password' name='senha' id='senha' placeholder='Senha do usuário'>\"+
                        \"<input type='text' hidden readonly value='" . $row['id'] . "' name='idUsuario'>\"+
                        \"<input type='text' hidden readonly value='" . $row['admin'] . "' name='cargoAtual'>\"+
                        \"<select name='tipo_usuario' id='tipo_usuario'>\" +
                        \"<option value='1' " . ($row['admin'] == 1 ? "selected" : "") . ">Administrador</option>\" +
                        \"<option value='2' " . ($row['admin'] == 2 ? "selected" : "") . ">Desenvolvedor</option>\" +
                        \"</select>\" +
                        \"<input type='hidden' name='atualizarUsuario'/>\" +
                        \"<input type='submit' value='Editar usuário'>\" +
                        \"</form>\";
            
                    </script>";
                }

                if (isset($_POST['registrar'])) {
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                    $admin = $_POST['admin'];
                    $createdAt = date('d-m-Y H:i:s');
                    $createdBy = $_SESSION['nomeCompleto'];


                    if ($nome == '') {
                        //Verifica se o gênero está vazio
                        Utilidades::dangerAlertDashboard('Você não informou o nome do usuário.');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //Valida se o email é realmente um email
                        Utilidades::dangerAlertDashboard('Email inválido.');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    } else if (strlen($senha) < 6) {
                        //Evita senhas fracas
                        Utilidades::dangerAlertDashboard('A senha é muito curta.');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    } else if (UsuariosModel::emailExists($email)) {
                        //Evita Emails repetidos
                        Utilidades::dangerAlertDashboard('O email já existe.');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    } else {
                        $senha = Bcrypt::hash($senha);
                        $registro = Mysql::connect()->prepare("INSERT INTO usuarios VALUES (null,?,?,?,?,?,?,?)");
                        $registro->execute(array($nome, $email, $senha, $ipaddress, $admin, $createdAt, $createdBy));

                        Utilidades::successAlertDashboard('Registrado com sucesso');
                        Utilidades::redirect(INCLUDE_PATH . 'usuarios');
                    }
                }
            } else {
                Utilidades::dangerAlertDashboard("Você não pode acessar essa página.");
                Utilidades::redirect(INCLUDE_PATH);
            }
        } else {
            //Renderiza tela de login
            Utilidades::dangerAlert("Você não está logado.");
            Utilidades::redirect(INCLUDE_PATH);
        }
    }
}

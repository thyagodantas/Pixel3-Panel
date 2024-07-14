<?php

class EmailsController
{

    public function index()
    {

        if (isset($_SESSION['login'])) {
            if ($_SESSION['cargo'] == 1) {
                # code...

                //Renderiza CMS
                MainView::render('emails');

                if (isset($_POST['excluir'])) {
                    if ($_SESSION['cargo'] == 1) {
                        $id = $_POST['id'];
                        EmailsModel::excluirEmail($id);
                        Utilidades::dangerAlertDashboard('Email excluído com sucesso!');
                        Utilidades::redirect(INCLUDE_PATH . 'emails');
                    } else {
                        Utilidades::dangerAlertDashboard('Você não tem permissão para excluir.');
                        Utilidades::redirect(INCLUDE_PATH . 'emails');
                    }
                }

                if (isset($_POST['verConteudo'])) {
                    // Obtém o valor do ID a partir da variável $_POST['conteudo']
                    $id = $_POST['conteudoId'];

                    // Executa a consulta SQL para selecionar o registro com o ID desejado
                    $sql = MySql::connect()->prepare("SELECT * FROM contato WHERE id = $id");
                    $sql->execute();

                    // Exibe o conteúdo do registro na página
                    $row = $sql->fetch();

                    echo "<script>
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = 'none';
                                window.location.href='" . INCLUDE_PATH . "emails" . "'
                            }
                        }
                        span.onclick = function () {
                            modal.style.display = 'none';
                            window.location.href='" . INCLUDE_PATH . "emails" . "'
                        }
                
                        modal.classList.add('show');
                
                        // Cria o elemento <div> para exibir o conteúdo
                        var div = document.createElement('div');

                        // Título
                        var titulo = document.createElement('p');
                        titulo.innerHTML = 'Dados do email';
                        titulo.setAttribute('style', 'text-align: center; font-weight: bold; padding-bottom: 20px;');

                
                        // Cria o elemento <p> para exibir o nome
                        var nome = document.createElement('p');
                        nome.innerHTML = 'Nome: " . $row['nome'] . "';
                        nome.setAttribute('style', 'text-align: center;');

                        // Cria o elemento <p> para exibir o email
                        var email = document.createElement('p');
                        email.innerHTML = 'Email: " . $row['email'] . "';
                        email.setAttribute('style', 'text-align: center;');
                
                        // Cria o elemento <p> para exibir o telefone
                        var telefone = document.createElement('p');
                        telefone.innerHTML = 'Telefone: " . $row['telefone'] . "';
                        telefone.setAttribute('style', 'text-align: center;');
                
                        // Cria o elemento <p> para exibir o categoria
                        var categoria = document.createElement('p');
                        categoria.innerHTML = 'Categoria: " . $row['categoria'] . "';
                        categoria.setAttribute('style', 'text-align: center;');

                        // Cria o elemento <p> para exibir o empresa
                        var empresa = document.createElement('p');
                        empresa.innerHTML = 'Empresa: " . $row['empresa'] . "';
                        empresa.setAttribute('style', 'text-align: center;');

                        // Cria o elemento <p> para exibir o mensagem
                        var mensagem = document.createElement('p');
                        mensagem.innerHTML = 'Mensagem: " . $row['mensagem'] . "';
                        mensagem.setAttribute('style', 'text-align: center;');
                
                        // Adiciona os elementos criados à <div> principal
                        div.appendChild(titulo);
                        div.appendChild(nome);
                        div.appendChild(email);
                        div.appendChild(telefone);
                        div.appendChild(categoria);
                        div.appendChild(empresa);
                        div.appendChild(mensagem);
                
                        // Limpa o conteúdo anterior e adiciona a nova <div> com o conteúdo desejado
                        conteudo.innerHTML = '';
                        conteudo.appendChild(div);
                
                    </script>";
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
<?php

class AvaliacoesController
{

    public function index()
    {
        if (isset($_SESSION['login'])) {

            //Renderiza CMS
            MainView::render('avaliacoes');

            if (isset($_POST['excluir'])) {
                if ($_SESSION['cargo'] == 1) {
                    $id = $_POST['id'];
                    AvaliacoesModel::excluirAvaliacoes($id);
                    Utilidades::dangerAlertDashboard('Avaliação excluída com sucesso!');
                    Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                } else {
                    Utilidades::dangerAlertDashboard('Você não tem permissão para excluir.');
                    Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                }
            }

            if (isset($_POST['atualizarAvaliacao'])) {
                if ($_SESSION['cargo'] == 1) {
                    $idAvaliacao = $_POST['idAvaliacao'];
                    $usuario = $_POST['nome'];
                    $textodaavaliacao = $_POST['textodaavaliacao'];
                    $site = $_POST['url'];


                    if ($usuario == '' || $textodaavaliacao == '' || $site == '') {
                        Utilidades::dangerAlertDashboard("Você deixou algum campo vazio.");
                        Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                    } else {
                        $pdo = MySql::connect();
                        $atualizarCliente = $pdo->prepare("UPDATE avaliacoes SET usuario = ?, textodaavaliacao = ?, site = ? WHERE id = ?");
                        $atualizarCliente->execute(array($usuario, $textodaavaliacao, $site, $idAvaliacao));

                        Utilidades::successAlertDashboard("Avaliação atualizada.");
                        Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                    }
                } else {
                    Utilidades::dangerAlertDashboard("Você não tem permissão.");
                    Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                }
            }

            if (isset($_POST['editar'])) {
                // Obtém o valor do ID a partir da variável $_POST['conteudo']
                $id = $_POST['editarId'];

                // Executa a consulta SQL para selecionar o registro com o ID desejado
                $sql = MySql::connect()->prepare("SELECT * FROM avaliacoes WHERE id = ?");
                $sql->execute(array($id));

                // Exibe o conteúdo do registro na página
                $row = $sql->fetch();


                echo "<script>
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                            window.location.href='" . INCLUDE_PATH . "avaliacoes" . "'
                        }
                    }
                    span.onclick = function () {
                        modal.style.display = 'none';
                        window.location.href='" . INCLUDE_PATH . "avaliacoes" . "'
                    }
            
                    modal.classList.add('show');
            
                    // Cria o elemento <div> para exibir o conteúdo
                    var div = document.createElement('form');
                    div.classList.add('clientes-form');
                    div.setAttribute('method', 'post');

                    // cria os elementos HTML e atribui os atributos
                    const inputNome = document.createElement('input');
                    inputNome.type = 'text';
                    inputNome.name = 'nome';
                    inputNome.id = 'nome';
                    inputNome.value = '" . $row['usuario'] . "';
                             
                    const inputUrl = document.createElement('input');
                    inputUrl.type = 'text';
                    inputUrl.name = 'url';
                    inputUrl.id = 'url';
                    inputUrl.value = '" . $row['site'] . "';

                    // Criando o elemento <textarea>
                    var textarea = document.createElement('textarea');
                    textarea.setAttribute('name', 'textodaavaliacao');
                    textarea.setAttribute('id', 'textodaavaliacao');
                    textarea.value = '" . $row['textodaavaliacao'] . "';

                    const inputHidden1 = document.createElement('input');
                    inputHidden1.type = 'hidden';
                    inputHidden1.name = 'atualizarAvaliacao';
                    inputHidden1.value = 'atualizarAvaliacao';
                    
                    const inputHidden2 = document.createElement('input');
                    inputHidden2.type = 'hidden';
                    inputHidden2.name = 'idAvaliacao';
                    inputHidden2.value = '" . $row['id'] . "';
                    
                    const inputSubmit = document.createElement('input');
                    inputSubmit.type = 'submit';
                    inputSubmit.value = 'Editar avaliação';
                    
                    // adiciona os elementos ao formulário
                    div.appendChild(inputNome);
                    div.appendChild(textarea);
                    div.appendChild(inputUrl);
                    div.appendChild(inputHidden1);
                    div.appendChild(inputHidden2);
                    div.appendChild(inputSubmit);
            
                    // Limpa o conteúdo anterior e adiciona a nova <div> com o conteúdo desejado
                    conteudo.innerHTML = '';
                    conteudo.appendChild(div);
            
                </script>";
            }

            if (isset($_POST['avaliacoes'])) {
                $usuario = $_POST['nome'];
                $textodaavaliacao = $_POST['textodaavaliacao'];
                $site = $_POST['url'];

                if ($usuario == '' || $site == '' || $textodaavaliacao == '') {
                    Utilidades::dangerAlertDashboard('Você deixou algum campo vazio.');
                    Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                } else {

                    $avaliacoes = MySql::connect()->prepare("INSERT INTO avaliacoes VALUES (null,?,?,?)");
                    $avaliacoes->execute(array($site, $textodaavaliacao, $usuario));

                    Utilidades::successAlertDashboard('Avaliação cadastrado com sucesso.');
                    Utilidades::redirect(INCLUDE_PATH . 'avaliacoes');
                }
            }
        } else {
            //Renderiza tela de login
            Utilidades::dangerAlert("Você não está logado.");
            Utilidades::redirect(INCLUDE_PATH);
        }
    }
}

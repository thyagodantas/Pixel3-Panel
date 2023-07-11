<?php

class ClientesController
{

    public function index()
    {
        if (isset($_SESSION['login'])) {

            //Renderiza CMS
            MainView::render('clientes');

            if (isset($_POST['excluir'])) {
                if ($_SESSION['cargo'] == 1) {
                    $id = $_POST['id'];
                    ClientesModel::excluirCliente($id);
                    Utilidades::dangerAlertDashboard('Cliente excluído com sucesso!');
                    Utilidades::redirect(INCLUDE_PATH . 'clientes');
                } else {
                    Utilidades::dangerAlertDashboard('Você não tem permissão para excluir.');
                    Utilidades::redirect(INCLUDE_PATH . 'clientes');
                }
            }

            if (isset($_POST['atualizarCliente'])) {
                if ($_SESSION['cargo'] == 1) {
                    $idCliente = $_POST['idCliente'];
                    $nome = $_POST['nome'];
                    $url = $_POST['url'];
                    $imagem = $_FILES['imagemAtualizar']['tmp_name'];
                    $tipo_imagem = $_FILES['imagemAtualizar']['type'];

                    // Verifica se o arquivo é uma imagem PNG, SVG ou WebP
                    if ($tipo_imagem == 'image/png' || $tipo_imagem == 'image/svg+xml' || $tipo_imagem == 'image/webp') {
                        $conteudo_imagem = file_get_contents($imagem);
                    }

                    if ($nome == '' || $url == '') {

                        Utilidades::dangerAlertDashboard("Você deixou algum campo vazio.");
                        Utilidades::redirect(INCLUDE_PATH . 'clientes');
                    }

                    if ($imagem == '') {

                        $pdo = MySql::connect();
                        $atualizarCliente = $pdo->prepare("UPDATE clientes SET nome = ?, url = ? WHERE id = ?");
                        $atualizarCliente->execute(array($nome, $url, $idCliente));

                        Utilidades::successAlertDashboard("Cliente atualizado.");
                        Utilidades::redirect(INCLUDE_PATH . 'clientes');
                    } else {

                        $pdo = MySql::connect();
                        $atualizarCliente = $pdo->prepare("UPDATE clientes SET nome = ?, url = ?, imagem = ? WHERE id = ?");
                        $atualizarCliente->execute(array($nome, $url, $conteudo_imagem, $idCliente));

                        Utilidades::successAlertDashboard("Cliente atualizado.");
                        Utilidades::redirect(INCLUDE_PATH . 'clientes');
                    }
                } else {
                    Utilidades::dangerAlertDashboard("Você não tem permissão.");
                    Utilidades::redirect(INCLUDE_PATH . 'clientes');
                }
            }

            if (isset($_POST['editar'])) {
                // Obtém o valor do ID a partir da variável $_POST['conteudo']
                $id = $_POST['editarId'];

                // Executa a consulta SQL para selecionar o registro com o ID desejado
                $sql = MySql::connect()->prepare("SELECT * FROM clientes WHERE id = ?");
                $sql->execute(array($id));

                // Exibe o conteúdo do registro na página
                $row = $sql->fetch();


                echo "<script>
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                            window.location.href='" . INCLUDE_PATH . "clientes" . "'
                        }
                    }
                    span.onclick = function () {
                        modal.style.display = 'none';
                        window.location.href='" . INCLUDE_PATH . "clientes" . "'
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
                    inputNome.value = '" . $row['nome'] . "';
                    
                    const inputImagem = document.createElement('input');
                    inputImagem.type = 'file';
                    inputImagem.name = 'imagemAtualizar';
                    inputImagem.id = 'imagemAtualizar';
                    
                    const inputUrl = document.createElement('input');
                    inputUrl.type = 'text';
                    inputUrl.name = 'url';
                    inputUrl.id = 'url';
                    inputUrl.value = '" . $row['url'] . "';

                    const inputHidden1 = document.createElement('input');
                    inputHidden1.type = 'hidden';
                    inputHidden1.name = 'atualizarCliente';
                    inputHidden1.value = 'atualizarCliente';
                    
                    const inputHidden2 = document.createElement('input');
                    inputHidden2.type = 'hidden';
                    inputHidden2.name = 'idCliente';
                    inputHidden2.value = '" . $row['id'] . "';
                    
                    const inputSubmit = document.createElement('input');
                    inputSubmit.type = 'submit';
                    inputSubmit.value = 'Editar cliente';
                    
                    // adiciona os elementos ao formulário
                    div.appendChild(inputNome);
                    div.appendChild(inputImagem);
                    div.appendChild(inputUrl);
                    div.appendChild(inputHidden1);
                    div.appendChild(inputHidden2);
                    div.appendChild(inputSubmit);
            
                    // Limpa o conteúdo anterior e adiciona a nova <div> com o conteúdo desejado
                    conteudo.innerHTML = '';
                    conteudo.appendChild(div);
            
                </script>";
            }

            if (isset($_POST['clientes'])) {
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem']['tmp_name'];
                $tipo_imagem = $_FILES['imagem']['type'];
                $url = $_POST['url'];

                if ($imagem == '' || $url == '') {
                    Utilidades::dangerAlertDashboard('Você deixou algum campo vazio.');
                    Utilidades::redirect(INCLUDE_PATH . 'clientes');
                } else {


                    // Verifica se o arquivo é uma imagem PNG, SVG ou WebP
                    if ($tipo_imagem == 'image/png' || $tipo_imagem == 'image/svg+xml' || $tipo_imagem == 'image/webp') {
                        $conteudo_imagem = file_get_contents($imagem);
                    }


                    $clientes = MySql::connect()->prepare("INSERT INTO clientes VALUES (null,?,?,?)");
                    $clientes->execute(array($conteudo_imagem, $url, $nome));

                    Utilidades::successAlertDashboard('Cliente cadastrado com sucesso.');
                    Utilidades::redirect(INCLUDE_PATH . 'clientes');
                }
            }
        } else {
            //Renderiza tela de login
            Utilidades::dangerAlert("Você não está logado.");
            Utilidades::redirect(INCLUDE_PATH);
        }
    }
}
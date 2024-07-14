<?php

class PortifolioController
{

    public function index()
    {
        if (isset($_SESSION['login'])) {

            //Renderiza CMS
            MainView::render('portifolio');

            if (isset($_POST['excluir'])) {
                if ($_SESSION['cargo'] == 1) {
                    $id = $_POST['id'];
                    PortifolioModel::excluirPortifolio($id);
                    Utilidades::dangerAlertDashboard('Portifólio excluído com sucesso!');
                    Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                } else {
                    Utilidades::dangerAlertDashboard('Você não tem permissão para excluir.');
                    Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                }
            }

            if (isset($_POST['verConteudo'])) {
                // Obtém o valor do ID a partir da variável $_POST['conteudo']
                $id = $_POST['conteudoId'];

                // Executa a consulta SQL para selecionar o registro com o ID desejado
                $sql = MySql::connect()->prepare("SELECT * FROM portifolio WHERE id = $id");
                $sql->execute();

                // Exibe o conteúdo do registro na página
                $row = $sql->fetch();

                echo "<script>
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                        }
                    }
                    span.onclick = function () {
                        modal.style.display = 'none';
                    }
            
                    modal.classList.add('show');
            
                    // Cria a tag <img> e define seus atributos
                    var img = document.createElement('img');
                    img.setAttribute('src', 'data:image/jpeg;base64," . base64_encode($row['imagem']) . "');
                    img.setAttribute('style', 'height: auto; max-width: 100%; cursor: pointer; border: 0.5px solid #ccc; border-radius: 3px 3px 3px 3px; box-shadow: 1px 1px 5px -1px rgba(0, 0, 0, 0.75);');
                    conteudo.innerHTML = '';
                    conteudo.appendChild(img);

                </script>";
            }

            if (isset($_POST['atualizarPortifolio'])) {
                if ($_SESSION['cargo'] == 1) {
                    $idPortifolio = $_POST['idPortifolio'];
                    $nome = $_POST['nome'];
                    $categoria = $_POST['categoria'];
                    $imagem = $_FILES['imagemAtualizar']['tmp_name'];
                    $tipo_imagem = $_FILES['imagemAtualizar']['type'];

                    // Verifica se o arquivo é uma imagem PNG, SVG ou WebP
                    if ($tipo_imagem == 'image/png' || $tipo_imagem == 'image/svg+xml' || $tipo_imagem == 'image/webp') {
                        $conteudo_imagem = file_get_contents($imagem);
                    }

                    if ($nome == '' || $categoria == '') {

                        Utilidades::dangerAlertDashboard("Você deixou algum campo vazio.");
                        Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                    }

                    if ($imagem == '') {

                        $pdo = MySql::connect();
                        $atualizarCliente = $pdo->prepare("UPDATE portifolio SET nome = ?, categoria = ? WHERE id = ?");
                        $atualizarCliente->execute(array($nome, $categoria, $idPortifolio));

                        Utilidades::successAlertDashboard("Portifólio atualizado.");
                        Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                    } else {

                        $pdo = MySql::connect();
                        $atualizarCliente = $pdo->prepare("UPDATE portifolio SET nome = ?, categoria = ?, imagem = ? WHERE id = ?");
                        $atualizarCliente->execute(array($nome, $categoria, $conteudo_imagem, $idPortifolio));

                        Utilidades::successAlertDashboard("Portifólio atualizado.");
                        Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                    }
                } else {
                    Utilidades::dangerAlertDashboard("Você não tem permissão.");
                    Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                }
            }

            if (isset($_POST['editar'])) {
                // Obtém o valor do ID a partir da variável $_POST['conteudo']
                $id = $_POST['editarId'];

                // Executa a consulta SQL para selecionar o registro com o ID desejado
                $sql = MySql::connect()->prepare("SELECT * FROM portifolio WHERE id = ?");
                $sql->execute(array($id));

                // Exibe o conteúdo do registro na página
                $row = $sql->fetch();


                echo "<script>
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = 'none';
                            window.location.href='" . INCLUDE_PATH . "portifolio" . "'
                        }
                    }
                    span.onclick = function () {
                        modal.style.display = 'none';
                        window.location.href='" . INCLUDE_PATH . "portifolio" . "'
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
                    inputUrl.name = 'categoria';
                    inputUrl.id = 'categoria';
                    inputUrl.value = '" . $row['categoria'] . "';

                    const inputHidden1 = document.createElement('input');
                    inputHidden1.type = 'hidden';
                    inputHidden1.name = 'atualizarPortifolio';
                    inputHidden1.value = 'atualizarPortifolio';
                    
                    const inputHidden2 = document.createElement('input');
                    inputHidden2.type = 'hidden';
                    inputHidden2.name = 'idPortifolio';
                    inputHidden2.value = '" . $row['id'] . "';
                    
                    const inputSubmit = document.createElement('input');
                    inputSubmit.type = 'submit';
                    inputSubmit.value = 'Editar portifólio';
                    
                    // adiciona os elementos ao formulário
                    div.appendChild(inputNome);
                    div.appendChild(inputUrl);
                    div.appendChild(inputImagem);
                    div.appendChild(inputHidden1);
                    div.appendChild(inputHidden2);
                    div.appendChild(inputSubmit);
            
                    // Limpa o conteúdo anterior e adiciona a nova <div> com o conteúdo desejado
                    conteudo.innerHTML = '';
                    conteudo.appendChild(div);
            
                </script>";
            }

            if (isset($_POST['portifolio'])) {
                $nome = $_POST['nome'];
                $categoria = $_POST['categoria'];
                $tipo_imagem = $_FILES['imagem']['type'];
                $imagem = $_FILES['imagem']['tmp_name'];

                if ($imagem == '' || $categoria == '') {
                    Utilidades::dangerAlertDashboard('Você deixou algum campo vazio.');
                    Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                } else {

                    try {
                        $uploadDirectory = '/app/images/';
                        $imageName = uniqid() . '_' . $_FILES['imagem']['name'];
                        $imagePath = $uploadDirectory . $imageName;
                        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagePath);

                        // Insert the file path into the database
                        $clientes = MySql::connect()->prepare("INSERT INTO portifolio VALUES (null,?,?,?)");
                        $clientes->execute(array($imagePath, $categoria, $nome));

                        Utilidades::successAlertDashboard('Portifólio cadastrado com sucesso.');
                        Utilidades::redirect(INCLUDE_PATH . 'portifolio');
                    } catch (PDOException $e) {
                        echo 'Erro no banco de dados: ' . $e->getMessage();
                    }
                }
            }
        } else {
            //Renderiza tela de login
            Utilidades::dangerAlert("Você não está logado.");
            Utilidades::redirect(INCLUDE_PATH);
        }
    }
}

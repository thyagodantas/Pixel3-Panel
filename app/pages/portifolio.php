<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE; ?>style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE; ?>alert.css">
    <script src="https://kit.fontawesome.com/99df909021.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <title>Portifolio | Painel</title>
</head>

<body>

    <?php include('includes/sidebar.php'); ?>

    <div class="content">

        <div class="box-content left w100">

            <h2><i class="fa-regular fa-browser"></i> Cadastrar no portifólio</h2>

            <div class="overview-content-clientes">
                <?php if (isset($_SESSION['dashboard'])) {
                    echo $_SESSION['dashboard'];

                    unset($_SESSION['dashboard']);
                }; ?>
                <form class="clientes-form" method="post" enctype="multipart/form-data">
                    <input type="text" name="nome" id="nome" placeholder="Nome do site">
                    <input type="text" name="categoria" id="categoria" placeholder="Categoria do site">
                    <input type="file" name="imagem" id="imagem">
                    <input type="hidden" name="portifolio" value="portifolio">
                    <input type="submit" value="Publicar site no portifólio">
                </form>

            </div>
        </div>


        <div id="myModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="conteudo-modal">
                    teste
                </p>
            </div>
        </div>



        <div class="box-content left w100">
            <h2><i class="fa-regular fa-list"></i> Sites cadastrados</h2>
            <div class="table-content">
                <table>
                    <tr>
                        <td>Nome</td>
                        <td>Categoria</td>
                        <td>Ação</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    $PaginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $porPagina = 4;
                    $resultados = PortifolioModel::listPortifolio(($PaginaAtual - 1) * $porPagina, $porPagina * $PaginaAtual);
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td><?php echo $resultado['nome']; ?></td>
                            <td><?php echo $resultado['categoria']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="verConteudo" value="verConteudo">
                                    <input type="hidden" name="conteudoId" value="<?php echo $resultado['id']; ?>">
                                    <button type="submit" title="verConteudo" class="ver-conteudo">
                                        Ver conteúdo
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="editar" value="editar">
                                    <input type="hidden" name="editarId" value="<?php echo $resultado['id']; ?>">
                                    <button type="submit" title="Editar" class="editar-conteudo">
                                        Editar
                                    </button>
                                </form>

                            </td>
                            <td>

                                <form method="post">
                                    <input type="hidden" name="excluir" value="excluir">
                                    <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
                                    <button type="submit" title="Excluir" class="delete-conteudo">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
            <div class="paginacao">
                <?php

                $totalPaginas = ceil(count(PortifolioModel::listPortifolio()) / $porPagina);

                # code...

                for ($i = 1; $i <= $totalPaginas; $i++) {

                    if ($i == $PaginaAtual) {
                        echo '<a class="pag-selected" href="?pagina=' . $i . '">' . $i . '</a>';
                    } else {
                        echo '<a href="?pagina=' . $i . '">' . $i . '</a>';
                    }
                }

                ?>
            </div>

        </div>
    </div>


    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("openModal");
        var conteudo = document.getElementById("conteudo-modal");
        var span = document.getElementsByClassName("close")[0];
    </script>
    <?php include('includes/scripts.php'); ?>

</body>

</html>
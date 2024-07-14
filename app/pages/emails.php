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
    <title>Emails | Painel</title>
</head>

<body>

    <?php include('includes/sidebar.php'); ?>

    <div class="content">



        <div id="myModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p id="conteudo-modal">
                    teste
                </p>
            </div>
        </div>



        <div class="box-content left w100">
            <h2><i class="fa-regular fa-envelope"></i> Caixa de entrada</h2>
            <?php if (isset($_SESSION['dashboard'])) {
                echo $_SESSION['dashboard'];

                unset($_SESSION['dashboard']);
            }; ?>
            <div class="table-content">
                <table>
                    <tr>
                        <td>Nome</td>
                        <td style="text-align:right">Ação</td>
                        <td></td>
                        <div class="clear"></div>
                    </tr>
                    <?php
                    $PaginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $porPagina = 4;
                    $resultados = EmailsModel::listEmails(($PaginaAtual - 1) * $porPagina, $porPagina * $PaginaAtual);
                    foreach ($resultados as $resultado) {
                    ?>
                    <tr>
                        <td><?php echo $resultado['nome']; ?></td>
                        <td style="float:right">

                            <form method="post">
                                <input type="hidden" name="excluir" value="excluir">
                                <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
                                <button type="submit" title="Excluir" class="delete-conteudo">
                                    Excluir
                                </button>
                            </form>
                            <div class="clear"></div>
                        </td>
                        <td style="float:right">
                            <form method="post">
                                <input type="hidden" name="verConteudo" value="verConteudo">
                                <input type="hidden" name="conteudoId" value="<?php echo $resultado['id']; ?>">
                                <button type="submit" title="Ver email" class="ver-conteudo">
                                    Ver email
                                </button>
                            </form>
                            <div class="clear"></div>
                        </td>
                    </tr>

                    <?php } ?>

                </table>
            </div>
            <div class="paginacao">
                <?php

                $totalPaginas = ceil(count(EmailsModel::listEmails()) / $porPagina);

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
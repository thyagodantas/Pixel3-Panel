<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE; ?>style.css">
    <script src="https://kit.fontawesome.com/99df909021.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta3/css/all.css">
    <title>Home | Painel</title>
</head>

<body>

    <?php include('includes/sidebar.php'); ?>

    <div class="content">

        <div class="box-content left w100">

            <h2><i class="fa-regular fa-chart-line"></i> Overview</h2>

            <div class="boxes w100">
                <div class="boxes-content">
                    <div class="title-boxes">
                        <h3>Clientes</h3>
                        <p><?php echo sprintf("%02d", ClientesModel::countClients()); ?></p>
                    </div>
                    <div class="icons-boxes">
                        <i class="fa-regular fa-user-tag"></i>
                    </div>
                </div>
                <div class="boxes-content">
                    <div class="title-boxes">
                        <h3>Avaliações</h3>
                        <p><?php echo sprintf("%02d", AvaliacoesModel::countAvaliacoes()); ?></p>
                    </div>
                    <div class="icons-boxes">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                </div>
                <div class="boxes-content">
                    <div class="title-boxes">
                        <h3>Portifólio</h3>
                        <p><?php echo sprintf("%02d", PortifolioModel::countPortifolio()); ?></p>
                    </div>
                    <div class="icons-boxes">
                        <i class="fa-regular fa-browser"></i>
                    </div>
                </div>
                <div class="boxes-content">
                    <div class="title-boxes">
                        <h3>Usuários</h3>
                        <p><?php echo sprintf("%02d", UsuariosModel::countUsuarios()); ?></p>
                    </div>
                    <div class="icons-boxes">
                        <i class="fa-regular fa-users"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include('includes/scripts.php'); ?>


</body>

</html>
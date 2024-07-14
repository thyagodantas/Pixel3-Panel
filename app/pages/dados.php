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
    <title>Alterar dados | Painel</title>
</head>

<body>

    <?php include('includes/sidebar.php'); ?>

    <div class="content">

        <div class="box-content left w100">

            <h2><i class="fa-regular fa-user-pen"></i> Alterar dados</h2>

            <div class="overview-content-clientes">
                <?php if (isset($_SESSION['dashboard'])) {
                    echo $_SESSION['dashboard'];

                    unset($_SESSION['dashboard']);
                }; ?>
                <form class="clientes-form" method="post">
                    <input type="text" name="nome" value="<?php echo $_SESSION['nomeCompleto']; ?>">
                    <input type="text" name="email" value="<?php echo $_SESSION['login']; ?>">
                    <input type="password" name="senha" placeholder="Sua nova senha">
                    <input type="hidden" name="atualizar" value="atualizar">
                    <input type="submit" value="Atualizar dados">
                </form>

            </div>
        </div>
    </div>

    <?php include('includes/scripts.php'); ?>

</body>

</html>
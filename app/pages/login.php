<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE; ?>login.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE; ?>alert.css">
    <title>Login - Pixel3</title>
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row align-items-center justify-content-sm-center vh-100">
                <div class="col-xx1-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 ">
                    <div class="card shadow-lg" style="border-color: #ccc;">
                        <div class="card-header text-center" style="border-top: 5px solid #082385;">
                            <a style="text-decoration: none;" href="#" class="h1"><b><img class="logo w-50"
                                        src="<?php echo INCLUDE_PATH_STATIC ?>pages/images/logo.png"></b>| LOGIN</a>
                        </div>
                        <div class="card-body p-5">
                            <form action="" method="post">
                                <?php if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }; ?>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value=""
                                        autofocus="">
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="senha">Senha</label>

                                    </div>
                                    <input id="senha" type="password" class="form-control" name="senha">
                                    <div class="mb-2">

                                    </div>

                                </div>

                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Login
                                    </button>
                                </div>
                                <input type="hidden" name="login" value="login">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
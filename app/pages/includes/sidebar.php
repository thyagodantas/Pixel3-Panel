<div class="sidebar">
    <div class="sidebar-wraper">
        <div class="logo">
            <img src="<?php echo INCLUDE_PATH_STATIC; ?>pages/images/logo-white.png" alt="">
        </div>
        <div class="sidebar-menu">
            <nav class="menus-sidebar-menu">
                <ul>
                    <li class="section-menu"><a href="<?php echo INCLUDE_PATH; ?>"><i class="fa-regular fa-house"></i>
                            Dashboard</a>
                    </li>
                    <li <?php selecionadoMenu('clientes'); ?>><a href="<?php echo INCLUDE_PATH; ?>clientes"><i
                                class="fa-regular fa-user-tag"></i>
                            Clientes
                        </a>
                    </li>
                    <li <?php selecionadoMenu('avaliacoes'); ?>><a href="<?php echo INCLUDE_PATH; ?>"><i
                                class="fa-regular fa-file-lines"></i> Avaliações
                        </a>
                    </li>
                    <li <?php selecionadoMenu('usuarios');
                        verificaPermissao(1) ?>><a href="<?php echo INCLUDE_PATH; ?>"><i
                                class="fa-regular fa-users"></i> Usuários
                        </a>
                    </li>
                    <li <?php selecionadoMenu('portifolio'); ?>><a href="<?php echo INCLUDE_PATH; ?>"><i
                                class="fa-regular fa-browser"></i> Portifólio
                        </a>
                    </li>
                    <br>
                    <li class="section-menu"><a href="<?php echo INCLUDE_PATH; ?>"><i
                                class="fa-regular fa-file-user"></i> Minha conta</a>
                    </li>
                    <li <?php selecionadoMenu('dados'); ?>><a href="<?php echo INCLUDE_PATH; ?>"><i
                                class="fa-regular fa-user-pen"></i> Alterar dados
                        </a>
                    </li>
                </ul>
            </nav>
            <nav class="cargo-menu">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>"><?php

                                                                if ($_SESSION['cargo'] == 1) {
                                                                    echo '<i class="fa-regular fa-crown"></i> Administrador';
                                                                } else {
                                                                    echo '<i class="fa-sharp fa-regular fa-rectangle-code"></i> Desenvolvedor';
                                                                }

                                                                ?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<header>
    <div class="center">
        <div class="menu-btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="user-menu">
        <a class="open-menu" href=""><?php echo $_SESSION['nome']; ?> <i
                class="fa-regular fa-square-arrow-down"></i></a>
    </div>

    <div class="mail-menu">
        <a href="">
            <i class="fa-solid fa-envelope"></i>
        </a>
    </div>
    </div>
    <div class="clear"></div>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>?logout"><i class="fa-solid fa-right-from-bracket"></i>
                    Logout</a></li>
        </ul>
    </nav>
</header>
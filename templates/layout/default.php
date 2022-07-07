<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/65752bfe62.js" crossorigin="anonymous"></script>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>
    <?= $this->Html->script('jquery-3.6.0.min.js'); ?>

    <link rel="stylesheet" href="https://unpkg.com/js-datepicker/dist/datepicker.min.css">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<?php
$isTheme = isset($_COOKIE["theme"]);
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") {
        $background = "#2a2b2e";
        $background2 = "#34373B";
        $color = "#fff";
    } else {
        $background = "#f5f7fa";
        $background2 = "#f9f9f9";
        $color = "#363637";
    }
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>


<body style="background-color: <?php echo $background; ?>!important;">
    <?php
    $params = $this->request->getAttributes()['params'];
    $controlador = $params['controller'];
    $url_link;
    if ($params['action'] == 'login' || $params['action'] == 'registrar') {
        $url_link = '/';
    } else {
        $url_link = '/mapa';
    }
    if ($this->request->getAttributes()['identity'] != null) {
        $user_data = $_SESSION['Auth'];
        $image_url = 'perfil/' . $user_data['imagen_perfil'];
        $tipoUser = $_SESSION['tipo'];
    }
    // $barbero = $_SESSION['Auth'];
    ?>
    <nav class="top-nav"
        style="background-color: <?php echo $background; ?>; border-bottom: 6px solid <?php echo $color; ?> box-shadow: 0 4px 6px -6px #222;">
        <div class="top-nav-title">
            <a style="text-decoration: none;" href="<?= $this->Url->build($url_link) ?>"><span
                    style="color: <?php echo $color; ?> !important; ">💈Tapelau💈</span></a>
        </div>
        <div class="top-nav-links">
            <label class="switch">
                <input type="checkbox" id="toggleTheme" <?php if ($isTheme) {
                                                            if ($_COOKIE["theme"] == "dark") {
                                                                echo "checked";
                                                            }
                                                        } ?>>
                <span class="slider round"></span>
            </label>
            <?php
            if ($this->request->getAttributes()['identity'] != null) {
            ?>
            <div class="dropdown">
                <span><?= $this->Html->image($image_url,  array('alt' => $image_url, 'class' => 'img_perfil')); ?></span>
                <div class="dropdown-content"
                    style="background-color: <?php echo $background2; ?>; color: <?php echo $color; ?> !important; ">
                    <ul style="list-style-type: none !important; ">
                        <!-- Se lista el menu del usuario, ya sea barbero o cliente. -->
                        <li>
                            <?= $this->Html->link('Perfil', $tipoUser . '/mi_perfil/' . $user_data['id'], ['style' => 'color:' . $color . '!important; text-decoration:none !important;']); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Mis reservas', $tipoUser . '/reservas/', ['style' => 'color:' . $color . '!important; text-decoration:none !important;']); ?>
                        </li>
                        <?php
                            if ($tipoUser == 'barbero') {
                            ?>

                        <!-- Si es Barbero con barberia lista 👇 -->
                        <?php
                                if ($_SESSION['barberia_'] != null) {
                                ?>
                        <li>
                            <?= $this->Html->link('Mi Barberia', '/barbershop/ver/' . $_SESSION['barberia_']['id'], ['style' => 'color:' . $color . '!important; text-decoration:none !important;']); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Invitar a barbería', '/barbershop/invitar', ['style' => 'color:' . $color . '!important; text-decoration:none !important;']); ?>
                        </li>
                        <li>
                            <?= $this->Html->link('Agregar horarios', '/horariobarbero/agregar', ['style' => 'color:' . $color . '!important; text-decoration:none !important;']); ?>
                        </li>
                        <?php
                                } else {
                                ?>
                        <li>
                            <?= $this->Html->link(('Nueva Barberia'), array('controller' => 'Barbershop', 'action' => 'agregar'), ['style' => 'color:' . $color . '!important; text-decoration:none !important;']) ?>
                        </li>
                        <?php
                                }
                                ?>
                        <li>
                            <?= $this->Html->link(('Cortes'), array('controller' => 'Corte', 'action' => 'index'), ['style' => 'color:' . $color . '!important; text-decoration:none !important;']) ?>
                        </li>


                        <!-- Si es Cliente lista 👇 -->
                        <?php
                            } else if ($tipoUser == 'cliente') {
                            ?>

                        <?php
                            }
                            ?>
                    </ul>
                    <?= $this->Html->link('Cerrar sesión', ['controller' => $_SESSION['tipo'], 'action' => 'logout'], ['class' => 'button float-right boton_cerrar', 'style' => 'text-decoration:none !important;']); ?>
                </div>
            </div>

        </div>
        <?php

            }
    ?>
    </nav>
    <nav class="top-nav">
        <?php
        if ($this->request->getAttributes()['identity'] != null) {

        ?>
        <div class="top-nav-links" style="
                display: flex;
                justify-content: space-around;
                padding: 10px;
                z-index: 2;
                position: relative;
                width: 100%;
                text-align: center;
                font-size: 4rem;
                ">
            <a href="http://localhost:8765/mapa"
                style="text-decoration:none; display:flex; flex-direction:column; justify-content: space-between; height:100%;"><i
                    style="color: <?php echo $color; ?> !important; " class="fas fa-map-marked-alt"></i>
                <h6
                    style="font-family:Arial;margin-bottom: 0;margin-top:1rem; color: <?php echo $color; ?> !important; ">
                    Barberías</h6>

            </a>
            <a href="http://localhost:8765/publicaciones"
                style="text-decoration:none;  display:flex; flex-direction:column; justify-content: space-between; height:100%;"><i
                    style="color: <?php echo $color; ?> !important; " class="fas fa-inbox"></i>
                <h6
                    style="font-family:Arial;margin-bottom: 0;margin-top:1rem; color: <?php echo $color; ?> !important; ">
                    Publicaciones</h6>
            </a>
        </div>
        <?php
        }
        ?>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
    <script>
    $("#toggleTheme").on('change', function() {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'true');
            document.cookie = "theme=dark; path=/;";
            location.reload();
        } else {
            $(this).attr('value', 'false');
            document.cookie = "theme=light; path=/;";
            location.reload();
        }
    });
    </script>
</body>

</html>
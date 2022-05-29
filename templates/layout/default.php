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

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?php
    $params = $this->request->getAttributes()['params'];
    $controlador = $params['controller'];
    $url_link;
    if ($params['action'] == 'login' || $params['action'] == 'registrar') {
        $url_link = '/';
    } else {
        if ($controlador == 'Barbero') {
            $url_link = '/barbero';
        } else if ($controlador == 'Cliente') {
            $url_link = '/cliente';
        } else {
            $url_link = '/mapa';
        }
    }
    if ($this->request->getAttributes()['identity'] != null) {
        $user_data = $_SESSION['Auth'];
        $image_url = 'perfil/' . $user_data['imagen_perfil'];
    }
    ?>
    <nav class="top-nav" style="box-shadow: 0 4px 6px -6px #222;">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build($url_link) ?>"><span>💈Tapelau💈</span></a>
        </div>
        <?php
        if ($this->request->getAttributes()['identity'] != null) {

        ?>
        <div class="top-nav-links">
            <div class="dropdown">
                <span><?= $this->Html->image($image_url,  array('alt' => $image_url, 'class' => 'img_perfil')); ?></span>
                <div class="dropdown-content">
                    <ul>
                        <!-- Se lista el menu del usuario, ya sea barbero o cliente. -->
                        <li>
                            <?= $this->Html->link('Perfil', $url_link . '/view/' . $user_data['id']); ?>
                        </li>
                        <!-- Si es Barbero lista 👇 -->
                        <?php
                            if ($controlador == 'Barbero') {
                            ?>
                        <!-- Si es Barbero con barberia lista 👇 -->
                        <?php
                                if ($_SESSION['barberia_'] != null) {
                                ?>
                        <li>
                            <?= $this->Html->link('Invitar a barbería', '/barbershop/invitar'); ?>
                        </li>
                        <?php
                                }
                                ?>


                        <!-- Si es Cliente lista 👇 -->
                        <?php
                            } else if ($controlador == 'Cliente') {
                            ?>

                        <?php
                            }
                            ?>
                    </ul>
                    <?= $this->Html->link('Cerrar sesión', ['controller' => $_SESSION['tipo'], 'action' => 'logout'], ['class' => 'button float-right boton_cerrar']); ?>
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
                style="display:flex; flex-direction:column; justify-content: space-between; height:100%;"><i
                    class="fas fa-map-marked-alt"></i>
                <h6 style="font-family:Arial;margin-bottom: 0;margin-top:1rem">Barberías</h6>
            </a>
            <a href="http://localhost:8765/publicaciones"
                style="display:flex; flex-direction:column; justify-content: space-between; height:100%;"><i
                    class="fas fa-inbox"></i>
                <h6 style="font-family:Arial;margin-bottom: 0;margin-top:1rem">Publicaciones</h6>
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
</body>

</html>
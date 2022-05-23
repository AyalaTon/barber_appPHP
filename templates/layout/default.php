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
        }
    }
    if ($this->request->getAttributes()['identity'] != null) {
        $user_data = $_SESSION['Auth'];
        $image_url = 'perfil/' . $user_data['imagen_perfil'];
    }
    ?>

    <section class="row">
        <aside class="column column-20 sidebar">
            <div class="side-nav sidebar_menu">
                <h4 class="heading">Navegación</h4>
                <ul>
                    <li>Home</li>
                    <li>Mapa</li>
                    <li>Barberias</li>
                </ul>
            </div>
        </aside>
        <div class="column column-80">
            <nav class="top-nav">
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

                            </ul>
                            <?= $this->Html->link('Cerrar sesión', ['action' => 'logout'], ['class' => 'button float-right boton_cerrar']); ?>
                        </div>
                    </div>

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
        </div>
    </section>

    <footer>
    </footer>
</body>

</html>
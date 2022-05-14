<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Barber App
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <div class="container text-center">
            <!-- <a href="https://cakephp.org/" target="_blank" rel="noopener">
                <img alt="CakePHP" src="https://cakephp.org/v2/img/logos/CakePHP_Logo.svg" width="350" />
            </a> -->
            <h1>
                💈Bienvenid@ a Barber App💈
            </h1>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row" style="display: flex; justify-content:center; ">
                    <h2>
                        Accede a nuestro sitio web para realizar tus reservas
                    </h2>
                </div>
                <div class="row" style="display: flex; justify-content:center;">
                    <?= $this->Html->link(__('Soy Cliente'), ['cliente/action' => 'login'], ['class' => 'button']) ?>
                </div>
                <div class="row" style="display: flex; justify-content:center;">
                    <?= $this->Html->link(__('Soy Barbero'), ['barbero/action' => 'login'], ['class' => 'button']) ?>
                </div>
                <div class="row" style="display: flex; justify-content:center;">
                    <?= $this->Html->link(__('Registrarme como Cliente'), array('controller' => 'cliente', 'action' => 'registrar'), ['class' => 'button button-outline']) ?>
                </div>
                <div class="row" style="display: flex; justify-content:center;">
                    <?= $this->Html->link(__('Registrarme como Barbero'), array('controller' => 'barbero', 'action' => 'registrar'), ['class' => 'button button-outline']) ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<?php

declare(strict_types=1);

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
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
    public function displayHomePage(): Response
    {
        return $this->display('home');
    }

    public function mapa(): Response
    {
        return $this->display('mapa');
    }

    public function publicaciones()
    {
        //Encuentro todas las publicaciones
        $publicacion = $this->loadModel('Publicacion')->find('all');
        $publicaciones = Array();
        $publicacionesInvertidas = Array(); //Mas reciente primero
        //Recorro todas las publicaciones y le seteo un campo barbershopInfo que contiene la información de la barbería 
        foreach ($publicacion as $publicacion) :
            $publicacion->barbershopInfo = $this->loadModel('Barbershop')->find('all')->where(['Barbershop.id' => $publicacion->barbershop_id])->first();
            $publicacion->image_urlServer = 'http://localhost/barber_appPHP/webroot/img/publicaciones/'.$publicacion->imagen;
            array_push($publicaciones, $publicacion);
        endforeach;
        //Invierto el array para que el mas reciente sea el primero
        for($i = count($publicaciones) - 1; $i >= 0; $i--) {
            array_push($publicacionesInvertidas, $publicaciones[$i]);
        }
        $this->set(compact('publicacionesInvertidas'));
    }
}

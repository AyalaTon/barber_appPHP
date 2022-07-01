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
use Cake\Utility\Security;

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

    public function mapa()
    {
        $barberias = $this->loadModel('Barbershop')->find('all');
        $listaBarberias = array();
        foreach ($barberias as $barberia) :
            array_push($listaBarberias, $barberia);
        endforeach;
        $this->set(compact('listaBarberias'));
        $this->display('mapa');
    }

    public function publicaciones()
    {
        $tipoUser = $_SESSION['tipo'];
        if ($tipoUser == 'barbero') {
            $allowAddPost = true;
        } else {
            $allowAddPost = false;
        }
        //Encuentro todas las publicaciones
        $publicacion = $this->loadModel('Publicacion')->find('all');
        $publicaciones = array();
        $publicacionesInvertidas = array(); //Mas reciente primero
        //Recorro todas las publicaciones y le seteo un campo barbershopInfo que contiene la información de la barbería 
        foreach ($publicacion as $publicacion) :
            $publicacion->barbershopInfo = $this->loadModel('Barbershop')->find('all')->where(['Barbershop.id' => $publicacion->barbershop_id])->first();
            $publicacion->image_urlServer = '/img/publicaciones/' . $publicacion->imagen;
            array_push($publicaciones, $publicacion);
        endforeach;
        //Invierto el array para que el mas reciente sea el primero
        for ($i = count($publicaciones) - 1; $i >= 0; $i--) {
            array_push($publicacionesInvertidas, $publicaciones[$i]);
        }

        if ($tipoUser == 'barbero') {
            $publicacion = $this->loadModel('Publicacion')->newEmptyEntity();
            $barberoLogeado = (int)$_SESSION['Auth']['id'];
            if ($this->request->is('post')) {
                $publicacion = $this->loadModel('Publicacion')->patchEntity($publicacion, $this->request->getData());
                //Obtener imagen de perfil
                $image = $this->request->getData('imagen');
                // debug($image);
                // exit;
                //Obtenemos el nombre de la imagen
                $name = $image->getClientFilename();
                //Si el nombre de la imagen no está vacío, es porque no seleccionó niguna imágen
                if ($name !== '') {
                    //Obtenemos la extensión de la imagen
                    $ext = substr(strtolower(strrchr($name, '.')), 1);
                    //Si no existe el directorio para guardar la imagen de perfil la creamos
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'publicaciones')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'publicaciones', 0775);
                    }
                    //Establecemos la ruta dónde queremos guardar la imagen
                    $myToken = Security::hash(Security::randomBytes(32), 'sha256', true);
                    $targetPath = WWW_ROOT . 'img' . DS . 'publicaciones' . DS . $barberoLogeado . '-' . $myToken . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $publicacion->imagen = $barberoLogeado . '-' . $myToken . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                    $publicacion->imagen = null; //'defaultPost.png';
                }
                if ($this->loadModel('Publicacion')->save($publicacion)) {
                    return $this->redirect(['controller' => 'Pages', 'action' => 'publicaciones']);
                }
            }
            $barbershop =  $this->loadModel('Publicacion')->Barbershop->find('list', ['limit' => 200])->all();
            $barbero = $this->loadModel('Barbero')->findById($barberoLogeado)->toList();
            $barbershopDeBarberoLogeado = $this->loadModel('BarberoBarbershop')->find('all')->where(['BarberoBarbershop.barbero_id' => $barberoLogeado])->first()->barbershop_id;
            $this->set(compact('publicacion', 'barbershopDeBarberoLogeado', 'barbershop', 'publicacionesInvertidas', 'allowAddPost'));
        } else {
            $this->set(compact('publicacionesInvertidas', 'allowAddPost'));
        }
    }

    
    public function eliminarPublicacion(){
        $id = $this->request->getData('publicacion_to_delete_id');
        $publicacion = $this->loadModel('Publicacion')->get($id);
        if ($this->loadModel('Publicacion')->delete($publicacion)) {
            $this->Flash->success(__('La publicación ha sido eliminada con éxito.'));
        } else {
            $this->Flash->error(__('La publicación no pudo ser eliminada.'));
        }

        return $this->redirect(['action' => 'publicaciones']);

    }
}
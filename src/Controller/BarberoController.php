<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Mailer\TransportFactory;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Barbero Controller
 *
 * @property \App\Model\Table\BarberoTable $Barbero
 * @method \App\Model\Entity\Barbero[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BarberoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        // exit;
        $barbero = $this->paginate($this->Barbero);

        $this->set(compact('barbero'));
        $this->set('_serialize', ['barbero']);
    }

    /**
     * View method
     *
     * @param string|null $id Barbero id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $barbero = $this->Barbero->get($id, [
            'contain' => ['Barbershop', 'CalificacionCliente', 'Corte', 'HorarioBarbero', 'ListaNegra'],
        ]);

        $this->set(compact('barbero'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $barbero = $this->Barbero->newEmptyEntity();
        if ($this->request->is('post')) {
            $barbero = $this->Barbero->patchEntity($barbero, $this->request->getData());
            if ($this->Barbero->save($barbero)) {
                $this->Flash->success(__('The barbero has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbero could not be saved. Please, try again.'));
        }
        $barbershop = $this->Barbero->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('barbero', 'barbershop'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Barbero id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $barbero = $this->Barbero->get($id, [
            'contain' => ['Barbershop'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $barbero = $this->Barbero->patchEntity($barbero, $this->request->getData());

            $this->Flash->success(__('The barbero has been saved.'));
            //Si el barbero no tiene ningún error
            if (!$barbero->getErrors) {
                //Obtener imagen de perfil
                $image = $this->request->getData('imagen_perfil');
                //Obtenemos el nombre de la imagen
                $name = $image->getClientFilename();
                //Si el nombre de la imagen no está vacío, es porque no seleccionó niguna imágen
                if ($name !== '') {
                    //Obtenemos la extensión de la imagen
                    $ext = substr(strtolower(strrchr($name, '.')), 1);
                    //Si no existe el directorio para guardar la imagen de perfil la creamos
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'perfil')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'perfil', 0775);
                    }
                    //Establecemos la ruta dónde queremos guardar la imagen
                    $targetPath = WWW_ROOT . 'img' . DS . 'perfil' . DS . $barbero->usuario . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $barbero->imagen_perfil = $barbero->usuario . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                    $barbero->imagen_perfil = 'default.png';
                }
            } else {
                $barbero->imagen_perfil = 'default.png';
            }

            if ($this->Barbero->save($barbero)) {
                $this->Flash->success(__('Todo joya. Please, try again.'));
                return $this->redirect(['action' => 'index']);
            }
        }
        $barbershop = $this->Barbero->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('barbero', 'barbershop'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Barbero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $barbero = $this->Barbero->get($id);
        if ($this->Barbero->delete($barbero)) {
            $this->Flash->success(__('The barbero has been deleted.'));
        } else {
            $this->Flash->error(__('The barbero could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //Registro de Barbero
    public function registrar()
    {
        $barbero = $this->Barbero->newEmptyEntity();
        if ($this->request->is('post')) {
            $barbero = $this->Barbero->patchEntity($barbero, $this->request->getData());
            //Si el barbero no tiene ningún error
            if (!$barbero->getErrors) {
                //Obtener imagen de perfil
                $image = $this->request->getData('imagen_perfil');
                //Obtenemos el nombre de la imagen
                $name = $image->getClientFilename();
                //Si el nombre de la imagen no está vacío, es porque no seleccionó niguna imágen
                if ($name !== '') {
                    //Obtenemos la extensión de la imagen
                    $ext = substr(strtolower(strrchr($name, '.')), 1);
                    //Si no existe el directorio para guardar la imagen de perfil la creamos
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'perfil')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'perfil', 0775);
                    }
                    //Establecemos la ruta dónde queremos guardar la imagen
                    $targetPath = WWW_ROOT . 'img' . DS . 'perfil' . DS . $barbero->usuario . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $barbero->imagen_perfil = $barbero->usuario . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                    $barbero->imagen_perfil = 'default.png';
                }
            } else {
                $barbero->imagen_perfil = 'default.png';
            }

            if ($this->Barbero->save($barbero)) {
                $this->Flash->success(__('El barbero ha sido creado con éxito.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('El barbero no ha podido ser creado. Por favor, intente nuevamente.'));
        }
        $barbershop = $this->Barbero->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('barbero', 'barbershop'));
        $this->set('_serialize', ['barbero']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Barbero',
                'action' => 'index',
            ]);
            $_SESSION["tipo"] =  "barbero";
            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Barbero', 'action' => 'login']);
        }
    }

    public function olvidarContrasena()
    {
        if ($this->request->is('post')) {
            //Obtenemos el email del usuario
            $myEmail = $this->request->getData('email');
            //Obtenemos el usuario que tiene ese email
            $barbero = $this->Barbero->findByEmail($myEmail)->first();
            //Creamos un Token para el usuario
            $myToken = Security::hash(Security::randomBytes(32), 'sha256', true);
            //Seteamos el token en el usuario
            $barbero->token = $myToken;
            //Guardamos el usuario
            if ($this->Barbero->save($barbero)) {
                //Enviamos mensaje de éxito
                $this->Flash->success(__('Se ha enviado un link para restablecer su contraseña a su correo electrónico(' . $barbero->email . ').'));
            }

            //Configuramos el correo
            TransportFactory::setConfig('mailtrap', [
                'host' => 'smtp.mailtrap.io',
                'port' => 2525,
                'username' => 'd88e91893889e5',
                'password' => 'bf4754e19fe31e',
                'className' => 'Smtp'
            ]);

            //Creamos el correo
            $mailer = new Mailer();
            //Seteamos la configuracion al correo
            $mailer->setTransport('gmail'); //Para enviar por Gmail y no usar el entorno de pruebas de mailtrap
            //$mailer->setTransport('mailtrap'); //Para utilizar el entorno de pruebas de mailtrap

            //Creamos el mensaje
            $mailer
                ->setEmailFormat('html')
                ->setTo($myEmail)
                // ->setFrom('tapelau@tapelau.com.uy')
                ->setSubject('Restablecer contraseña')
                ->deliver('Hola ' . $barbero->nombre . ', para restablecer su contraseña haga click en el siguiente enlace: <br><a href="http://localhost:8765/barbero/restablecerContrasena/' . $barbero->token . '">Restablecer contraseña</a>');
        }
    }

    public function restablecerContrasena($token)
    {
        if ($this->request->is('post')) {
            //Obtenemos el usuario que tiene ese token
            $barbero = $this->Barbero->findByToken($token)->first();
            /*echo "1##".$token.'<br>';
            echo "2##".$cliente->clave.'<br>';*/
            //Seteamos la nueva contraseña
            $barbero->clave = $this->request->getData('clave');
            /*echo "3##".$cliente->clave.'<br>';
            debug($cliente);*/
            if ($this->Barbero->save($barbero)) {
                $this->Flash->success(__('La contraseña ha sido cambiada'));
                return $this->redirect(['controller' => 'Barbero', 'action' => 'login']);
            }
            $this->Flash->error(__('La contraseña no ha sido cambiada'));
        }
    }

    public function miPerfil($id = null)
    {
        $barbero = $this->Barbero->get($id, [
            'contain' => ['Barbershop', 'CalificacionCliente', 'Corte', 'HorarioBarbero', 'ListaNegra'],
        ]);

        $this->set(compact('barbero'));
    }
}
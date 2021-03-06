<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Mailer\TransportFactory;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Cliente Controller
 *
 * @property \App\Model\Table\ClienteTable $Cliente
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClienteController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cliente = $this->paginate($this->Cliente);

        $this->set(compact('cliente'));
    }

    /**
     * View method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cliente = $this->Cliente->get($id, [
            'contain' => ['CalificacionCliente', 'CalificacionCorte', 'ListaNegra', 'Reserva'],
        ]);

        $this->set(compact('cliente'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cliente = $this->Cliente->newEmptyEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Cliente->patchEntity($cliente, $this->request->getData());
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('cliente'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cliente = $this->Cliente->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cliente = $this->Cliente->patchEntity($cliente, $this->request->getData());
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('cliente'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cliente id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cliente = $this->Cliente->get($id);
        if ($this->Cliente->delete($cliente)) {
            $this->Flash->success(__('The cliente has been deleted.'));
        } else {
            $this->Flash->error(__('The cliente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //Registro de Cliente
    public function registrar()
    {
        $cliente = $this->Cliente->newEmptyEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Cliente->patchEntity($cliente, $this->request->getData());
            //Si el Cliente no tiene ning??n error
            if (!$cliente->getErrors) {
                //Obtener imagen de perfil
                $image = $this->request->getData('imagen_perfil');
                //Obtenemos el nombre de la imagen
                $name = $image->getClientFilename();
                //Si el nombre de la imagen no est?? vac??o, es porque no seleccion?? niguna im??gen
                if ($name !== '') {
                    //Obtenemos la extensi??n de la imagen
                    $ext = substr(strtolower(strrchr($name, '.')), 1);
                    //Si no existe el directorio para guardar la imagen de perfil la creamos
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'perfil')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'perfil', 0775);
                    }
                    //Establecemos la ruta d??nde queremos guardar la imagen
                    $targetPath = WWW_ROOT . 'img' . DS . 'perfil' . DS . $cliente->usuario . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $cliente->imagen_perfil = $cliente->usuario . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna im??gen, se le asigna una por defecto
                    $cliente->imagen_perfil = 'default.png';
                }
            } else {
                $cliente->imagen_perfil = 'default.png';
            }

            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The cliente could not be saved. Please, try again.'));
        }
        $this->set(compact('cliente'));
        $this->set('_serialize', ['cliente']);
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
        // debug($this->request);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Pages',
                'action' => 'mapa',
            ]);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // session_start();
            $_SESSION["tipo"] =  "cliente";
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
            return $this->redirect(['controller' => 'Cliente', 'action' => 'login']);
        }
    }

    public function olvidarContrasena()
    {
        if ($this->request->is('post')) {
            //Obtenemos el email del usuario
            $myEmail = $this->request->getData('email');
            //Obtenemos el usuario que tiene ese email
            $cliente = $this->Cliente->findByEmail($myEmail)->first();
            //Creamos un Token para el usuario
            $myToken = Security::hash(Security::randomBytes(32), 'sha256', true);
            //Seteamos el token en el usuario
            $cliente->token = $myToken;
            //Guardamos el usuario
            if ($this->Cliente->save($cliente)) {
                //Enviamos mensaje de ??xito
                $this->Flash->success(__('Se ha enviado un link para restablecer su contrase??a a su correo electr??nico(' . $cliente->email . ').'));
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
                ->setFrom('tapelau@tapelau.com.uy')
                ->setSubject('Restablecer contrase??a')
                ->deliver('Hola ' . $cliente->nombre . ', para restablecer su contrase??a haga click en el siguiente enlace: <br><a href="http://localhost:8765/cliente/restablecerContrasena/' . $cliente->token . '">Restablecer contrase??a</a>');
        }
    }

    public function restablecerContrasena($token)
    {
        if ($this->request->is('post')) {
            //Obtenemos el usuario que tiene ese token
            $cliente = $this->Cliente->findByToken($token)->first();
            /*echo "1##".$token.'<br>';
            echo "2##".$cliente->clave.'<br>';*/
            //Seteamos la nueva contrase??a
            $cliente->clave = $this->request->getData('clave');
            /*echo "3##".$cliente->clave.'<br>';
            debug($cliente);*/
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('La contrase??a ha sido cambiada'));
                return $this->redirect(['controller' => 'Cliente', 'action' => 'login']);
            }
            $this->Flash->error(__('La contrase??a no ha sido cambiada'));
        }
    }
    public function miPerfil($id = null)
    {
        $cliente = $this->Cliente->get($id);
        $this->set(compact('cliente'));
        $this->set('_serialize', ['cliente']);
    }

    public function reservas()
    {
        // debug($_SESSION['Auth']['id']);
        $reservas = $this->Cliente->Reserva->findByClienteId($_SESSION['Auth']['id'])->toArray();
        $cortes_reserva = [];
        $barberos_reserva = [];
        foreach ($reservas as $reserva) {
            array_push($cortes_reserva, $this->Cliente->Reserva->Corte->findById($reserva['corte_id'])->first());
        }
        foreach ($cortes_reserva as $corte) {
            array_push($barberos_reserva, $this->Cliente->Reserva->Corte->Barbero->findById($corte['barbero_id'])->first());
        }
        // debug($cortes_reserva);
        // debug($barberos_reserva);
        $this->set(compact('reservas', 'cortes_reserva', 'barberos_reserva'));
    }
}
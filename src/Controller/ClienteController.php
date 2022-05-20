<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Cake\Utility\Security;
use Cake\Mailer\TransportFactory;

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
            //Si el Cliente no tiene ningún error
            if (!$cliente->getErrors) {
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
                    $targetPath = WWW_ROOT . 'img' . DS . 'perfil' . DS . $cliente->usuario . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $cliente->imagen_perfil = $cliente->usuario . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                    $cliente->imagen_perfil = 'default.png';
                }
            } else {
                $cliente->imagen_perfil = 'default.png';
            }

            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('The cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
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
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Cliente',
                'action' => 'index',
            ]);

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
            $myEmail = $this->request->getData('email');
            $cliente = $this->Cliente->findByEmail($myEmail)->first();
            $myToken = Security::hash(Security::randomBytes(32), 'sha256', true);
            $cliente->clave = $myToken;
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('Se ha enviado un link para restablecer su contraseña a su correo electrónico(' . $myEmail . ').'));
            }

            $dest = $myEmail;
            $subjetc = "Restablecer contraseña";
            $body = 'Hola ' . $cliente->nombre . ', para restablecer su contraseña haga click en el siguiente enlace: http://localhost:8888/cliente/restablecerContrasena/' . $cliente->clave;
            $headers = "From: tapelaubarberapp@gmail.com";
            if (mail($dest, $subjetc, $body, $headers)) {
              echo "Email successfully sent to $dest ...";
            } else {
              echo "Failed to send email...";
            }

            /*TransportFactory::setConfig('mailtrap', [
                'host' => 'smtp.mailtrap.io',
                'port' => 2525,
                'username' => 'd88e91893889e5',
                'password' => 'bf4754e19fe31e',
                'className' => 'Smtp'
            ]);

            $mailer = new Mailer();
            $mailer
                ->setEmailFormat('html')
                ->setTo($myEmail)
                ->setFrom('tapelau@tapelau.com.uy')
                ->setSubject('Restablecer contraseña')
                ->deliver('Hola ' . $cliente->nombre . ', para restablecer su contraseña haga click en el siguiente enlace: http://localhost:8888/cliente/restablecerContrasena/' . $cliente->clave);
            $mailer->deliver();*/

            /*$email = new Mailer('default');
            $email->emailFormat('html');
            $email->from('federzvz@gmail.com', 'Tapelau App');
            $email->subject('Restablecer contraseña');
            $email->to($myEmail);
            $email->send('Hola ' . $cliente->nombre . ', para restablecer su contraseña haga click en el siguiente enlace: http://localhost:8888/cliente/restablecerContrasena/' . $cliente->clave);*/
        }
    }

    public function restablecerContrasena($token)
    {
        if ($this->request->is('post')) {
            $cliente = $this->Cliente->get($this->Auth->user('id'));
            $cliente->password = $this->request->getData('password');
            if ($this->Cliente->save($cliente)) {
                $this->Flash->success(__('La contraseña ha sido cambiada'));
                return $this->redirect(['controller' => 'Cliente', 'action' => 'index']);
            }
            $this->Flash->error(__('La contraseña no ha sido cambiada'));
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Controller;

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
}

<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;
/**
 * Publicacion Controller
 *
 * @property \App\Model\Table\PublicacionTable $Publicacion
 * @method \App\Model\Entity\Publicacion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicacionController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Barbershop'],
        ];
        $publicacion = $this->paginate($this->Publicacion);

        $this->set(compact('publicacion'));
    }

    /**
     * View method
     *
     * @param string|null $id Publicacion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $publicacion = $this->Publicacion->get($id, [
            'contain' => ['Barbershop'],
        ]);

        $this->set(compact('publicacion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $publicacion = $this->Publicacion->newEmptyEntity();
        $barberoLogeado = (int)$_SESSION['Auth']['id'];
        if ($this->request->is('post')) {
            $publicacion = $this->Publicacion->patchEntity($publicacion, $this->request->getData());
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
                $targetPath = WWW_ROOT . 'img' . DS . 'publicaciones' . DS . $barberoLogeado . '-'. $myToken . '.' . $ext;
                //Movemos la imagen a la carpeta
                if ($name)
                    $image->moveTo($targetPath);
                //Guardamos el registro
                $publicacion->imagen = $barberoLogeado . '-'. $myToken . '.' . $ext;
            } else {
                //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                $publicacion->imagen = null;//'defaultPost.png';
            }
            if ($this->Publicacion->save($publicacion)) {
                $this->Flash->success(__('The publicacion has been saved.'));

                return $this->redirect(['controller'=>'Pages','action' => 'publicaciones']);
            }
            $this->Flash->error(__('The publicacion could not be saved. Please, try again.'));
        }
        $barbershop = $this->Publicacion->Barbershop->find('list', ['limit' => 200])->all();
        $barbero = $this->loadModel('Barbero')->findById($barberoLogeado)->toList();
        $barbershopDeBarberoLogeado = $this->loadModel('BarberoBarbershop')->find('all')->where(['BarberoBarbershop.barbero_id' => $barberoLogeado])->first()->barbershop_id;
        $this->set(compact('publicacion', 'barbershopDeBarberoLogeado','barbershop'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Publicacion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $publicacion = $this->Publicacion->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $publicacion = $this->Publicacion->patchEntity($publicacion, $this->request->getData());
            if ($this->Publicacion->save($publicacion)) {
                $this->Flash->success(__('The publicacion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The publicacion could not be saved. Please, try again.'));
        }
        $barbershop = $this->Publicacion->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('publicacion', 'barbershop'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Publicacion id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $publicacion = $this->Publicacion->get($id);
        if ($this->Publicacion->delete($publicacion)) {
            $this->Flash->success(__('The publicacion has been deleted.'));
        } else {
            $this->Flash->error(__('The publicacion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    // public function getBarbershop() {
    //     $barbero_id = (int)$_SESSION['Auth']['id'];
    //     // $barbershop = $this->Publicacion->Barbershop->find('all', ['conditions' => ['Barbershop.barbero_id' => $barbero_id]])->first();
    //     $barbershop =;
    // }
    // public function getBarbershop($barbero_id) {
    //     $barbershop = $this->Barbershop->find('all', ['conditions' => ['Barbershop.barbero_id' => $barbero_id]])->first();
    //     $this->set(compact('barbershop'));
    // }
    // public function getBarbershop(){
    //     $barbero_id = (int)$_SESSION['Auth']['id'];
    //     $barbershop = $this->Barbershop->find('all', ['conditions' => ['Barbershop.barbero_id' => $barbero_id]])->first();
    //     $this->set(compact('barbershop'));
    // }
}

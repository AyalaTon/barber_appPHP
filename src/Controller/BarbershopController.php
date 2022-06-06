<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Barbershop Controller
 *
 * @property \App\Model\Table\BarbershopTable $Barbershop
 * @var \App\Model\Entity\BarberoBarbershop $BarberoBarbershop
 * @method \App\Model\Entity\Barbershop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BarbershopController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $barbershop = $this->paginate($this->Barbershop);

        $this->set(compact('barbershop'));
    }

    /**
     * View method
     *
     * @param string|null $id Barbershop id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $barbershop = $this->Barbershop->get($id, [
            'contain' => ['Barbero', 'Publicacion'],
        ]);

        $this->set(compact('barbershop'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $barbershop = $this->Barbershop->newEmptyEntity();
        if ($this->request->is('post')) {
            $barbershop = $this->Barbershop->patchEntity($barbershop, $this->request->getData());
            if ($this->Barbershop->save($barbershop)) {
                $this->Flash->success(__('The barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->Barbershop->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('barbershop', 'barbero'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Barbershop id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $barbershop = $this->Barbershop->get($id, [
            'contain' => ['Barbero'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $barbershop = $this->Barbershop->patchEntity($barbershop, $this->request->getData());
            if ($this->Barbershop->save($barbershop)) {
                $this->Flash->success(__('The barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->Barbershop->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('barbershop', 'barbero'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Barbershop id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $barbershop = $this->Barbershop->get($id);
        if ($this->Barbershop->delete($barbershop)) {
            $this->Flash->success(__('The barbershop has been deleted.'));
        } else {
            $this->Flash->error(__('The barbershop could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function agregar()
    {
        $barbershop = $this->Barbershop->newEmptyEntity();
        if ($this->request->is('post')) {
            $barbershop = $this->Barbershop->patchEntity($barbershop, $this->request->getData());
            if (!$barbershop->getErrors) {
                //Obtener imagen de perfil de la barberia
                $image = $this->request->getData('imagen_perfil');
                //Obtenemos el nombre de la imagen
                $name = $image->getClientFilename();
                //Si el nombre de la imagen no está vacío, es porque no seleccionó niguna imágen
                if ($name !== '') {
                    //Obtenemos la extensión de la imagen
                    $ext = substr(strtolower(strrchr($name, '.')), 1);
                    //Si no existe el directorio para guardar la imagen de perfil la creamos
                    if (!is_dir(WWW_ROOT . 'img' . DS . 'barbershop')) {
                        mkdir(WWW_ROOT . 'img' . DS . 'barbershop', 0775);
                    }
                    //Establecemos la ruta dónde queremos guardar la imagen
                    $targetPath = WWW_ROOT . 'img' . DS . 'barbershop' . DS . $barbershop->nombre . '.' . $ext;
                    //Movemos la imagen a la carpeta
                    if ($name)
                        $image->moveTo($targetPath);
                    //Guardamos el registro
                    $barbershop->imagen_perfil = $barbershop->nombre . '.' . $ext;
                } else {
                    //En caso de que no haya seleccionado ninguna imágen, se le asigna una por defecto
                    $barbershop->imagen_perfil = 'default.png';
                }
            } else {
                $barbershop->imagen_perfil = 'default.png';
            }
            if ($this->Barbershop->save($barbershop)) {
                $this->Flash->success(__('The barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->Barbershop->Barbero->find('list', ['limit' => 200])->all();
        $barberoLogeado = (int)$_SESSION['Auth']['id'];
        $this->set(compact('barbershop', 'barbero', 'barberoLogeado'));
    }



    public function invitar()
    {

        $barberoLogeado = (int)$_SESSION['Auth']['id'];
        $barbershop = $this->Barbershop->newEmptyEntity();
        if ($this->request->is('post')) {
            $barberoId = $this->request->getData('barbero_id');
            $barbershopId = $this->request->getData('barbershop_id');

            if ($this->Barbershop->BarberoBarbershop->save($barbershop)) {
                $this->Flash->success(__('The barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbershop could not be saved. Please, try again.'));
        }

        $barbero = $this->Barbershop->Barbero->find('list', ['limit' => 200])->all();

        //Se obtiene la barberia del barbero logeado.
        $barbershopDeBarbero = $this->Barbershop->BarberoBarbershop->findByBarberoId($barberoLogeado)->all();
        //  ($barberoLogeado)->first();
        // debug($barbershopDeBarbero);

        $options = array(
            'fields' => array(
                'BarberoBarbershop.barbero_id',
            ),
        );

        $data = $this->Barbershop->BarberoBarbershop->find('all', $options);

        $barberosSinBarberias = $this->Barbershop->Barbero->find('all')->contain(['BarberoBarbershop'])->where(['Barbero.id NOT IN' => $data])->all()->toArray();


        $this->set(compact('barbershop', 'barbero', 'barberoLogeado', 'barberosSinBarberias'));
    }
}
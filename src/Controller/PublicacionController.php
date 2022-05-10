<?php
declare(strict_types=1);

namespace App\Controller;

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
        if ($this->request->is('post')) {
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
}

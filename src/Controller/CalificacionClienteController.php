<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CalificacionCliente Controller
 *
 * @property \App\Model\Table\CalificacionClienteTable $CalificacionCliente
 * @method \App\Model\Entity\CalificacionCliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CalificacionClienteController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Barbero', 'Cliente'],
        ];
        $calificacionCliente = $this->paginate($this->CalificacionCliente);

        $this->set(compact('calificacionCliente'));
    }

    /**
     * View method
     *
     * @param string|null $id Calificacion Cliente id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $calificacionCliente = $this->CalificacionCliente->get($id, [
            'contain' => ['Barbero', 'Cliente'],
        ]);

        $this->set(compact('calificacionCliente'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $calificacionCliente = $this->CalificacionCliente->newEmptyEntity();
        if ($this->request->is('post')) {
            $calificacionCliente = $this->CalificacionCliente->patchEntity($calificacionCliente, $this->request->getData());
            if ($this->CalificacionCliente->save($calificacionCliente)) {
                $this->Flash->success(__('The calificacion cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calificacion cliente could not be saved. Please, try again.'));
        }
        $barbero = $this->CalificacionCliente->Barbero->find('list', ['limit' => 200])->all();
        $cliente = $this->CalificacionCliente->Cliente->find('list', ['limit' => 200])->all();
        $this->set(compact('calificacionCliente', 'barbero', 'cliente'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Calificacion Cliente id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $calificacionCliente = $this->CalificacionCliente->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calificacionCliente = $this->CalificacionCliente->patchEntity($calificacionCliente, $this->request->getData());
            if ($this->CalificacionCliente->save($calificacionCliente)) {
                $this->Flash->success(__('The calificacion cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calificacion cliente could not be saved. Please, try again.'));
        }
        $barbero = $this->CalificacionCliente->Barbero->find('list', ['limit' => 200])->all();
        $cliente = $this->CalificacionCliente->Cliente->find('list', ['limit' => 200])->all();
        $this->set(compact('calificacionCliente', 'barbero', 'cliente'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Calificacion Cliente id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $calificacionCliente = $this->CalificacionCliente->get($id);
        if ($this->CalificacionCliente->delete($calificacionCliente)) {
            $this->Flash->success(__('The calificacion cliente has been deleted.'));
        } else {
            $this->Flash->error(__('The calificacion cliente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

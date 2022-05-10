<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Corte Controller
 *
 * @property \App\Model\Table\CorteTable $Corte
 * @method \App\Model\Entity\Corte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CorteController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Barbero'],
        ];
        $corte = $this->paginate($this->Corte);

        $this->set(compact('corte'));
    }

    /**
     * View method
     *
     * @param string|null $id Corte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $corte = $this->Corte->get($id, [
            'contain' => ['Barbero', 'CalificacionCorte', 'Reserva'],
        ]);

        $this->set(compact('corte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $corte = $this->Corte->newEmptyEntity();
        if ($this->request->is('post')) {
            $corte = $this->Corte->patchEntity($corte, $this->request->getData());
            if ($this->Corte->save($corte)) {
                $this->Flash->success(__('The corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The corte could not be saved. Please, try again.'));
        }
        $barbero = $this->Corte->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('corte', 'barbero'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Corte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $corte = $this->Corte->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $corte = $this->Corte->patchEntity($corte, $this->request->getData());
            if ($this->Corte->save($corte)) {
                $this->Flash->success(__('The corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The corte could not be saved. Please, try again.'));
        }
        $barbero = $this->Corte->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('corte', 'barbero'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Corte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $corte = $this->Corte->get($id);
        if ($this->Corte->delete($corte)) {
            $this->Flash->success(__('The corte has been deleted.'));
        } else {
            $this->Flash->error(__('The corte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

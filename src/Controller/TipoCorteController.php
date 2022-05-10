<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TipoCorte Controller
 *
 * @property \App\Model\Table\TipoCorteTable $TipoCorte
 * @method \App\Model\Entity\TipoCorte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipoCorteController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tipoCorte = $this->paginate($this->TipoCorte);

        $this->set(compact('tipoCorte'));
    }

    /**
     * View method
     *
     * @param string|null $id Tipo Corte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tipoCorte = $this->TipoCorte->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tipoCorte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipoCorte = $this->TipoCorte->newEmptyEntity();
        if ($this->request->is('post')) {
            $tipoCorte = $this->TipoCorte->patchEntity($tipoCorte, $this->request->getData());
            if ($this->TipoCorte->save($tipoCorte)) {
                $this->Flash->success(__('The tipo corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo corte could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoCorte'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Corte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoCorte = $this->TipoCorte->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoCorte = $this->TipoCorte->patchEntity($tipoCorte, $this->request->getData());
            if ($this->TipoCorte->save($tipoCorte)) {
                $this->Flash->success(__('The tipo corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo corte could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoCorte'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Corte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoCorte = $this->TipoCorte->get($id);
        if ($this->TipoCorte->delete($tipoCorte)) {
            $this->Flash->success(__('The tipo corte has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo corte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

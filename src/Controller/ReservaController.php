<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Reserva Controller
 *
 * @property \App\Model\Table\ReservaTable $Reserva
 * @method \App\Model\Entity\Reserva[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cliente', 'Corte'],
        ];
        $reserva = $this->paginate($this->Reserva);

        $this->set(compact('reserva'));
    }

    /**
     * View method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reserva = $this->Reserva->get($id, [
            'contain' => ['Cliente', 'Corte'],
        ]);

        $this->set(compact('reserva'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reserva = $this->Reserva->newEmptyEntity();
        if ($this->request->is('post')) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $cliente = $this->Reserva->Cliente->find('list', ['limit' => 200])->all();
        $corte = $this->Reserva->Corte->find('list', ['limit' => 200])->all();
        $this->set(compact('reserva', 'cliente', 'corte'));
    }

    public function corte($id_corte = null)
    {
        $reserva = $this->Reserva->newEmptyEntity();
        if ($this->request->is('post')) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $cliente = $this->Reserva->Cliente->find('list', ['limit' => 200])->all();
        $corte = $this->Reserva->Corte->find('list', ['limit' => 200])->all();
        $this->set(compact('reserva', 'cliente', 'corte'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reserva = $this->Reserva->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('The reserva has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reserva could not be saved. Please, try again.'));
        }
        $cliente = $this->Reserva->Cliente->find('list', ['limit' => 200])->all();
        $corte = $this->Reserva->Corte->find('list', ['limit' => 200])->all();
        $this->set(compact('reserva', 'cliente', 'corte'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reserva id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reserva = $this->Reserva->get($id);
        if ($this->Reserva->delete($reserva)) {
            $this->Flash->success(__('The reserva has been deleted.'));
        } else {
            $this->Flash->error(__('The reserva could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
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
        $barbero = $this->paginate($this->Barbero);

        $this->set(compact('barbero'));
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
}

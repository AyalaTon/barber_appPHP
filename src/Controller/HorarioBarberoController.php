<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * HorarioBarbero Controller
 *
 * @property \App\Model\Table\HorarioBarberoTable $HorarioBarbero
 * @method \App\Model\Entity\HorarioBarbero[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HorarioBarberoController extends AppController
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
        $horarioBarbero = $this->paginate($this->HorarioBarbero);

        $this->set(compact('horarioBarbero'));
    }

    /**
     * View method
     *
     * @param string|null $id Horario Barbero id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $horarioBarbero = $this->HorarioBarbero->get($id, [
            'contain' => ['Barbero'],
        ]);

        $this->set(compact('horarioBarbero'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $horarioBarbero = $this->HorarioBarbero->newEmptyEntity();
        if ($this->request->is('post')) {
            $horarioBarbero = $this->HorarioBarbero->patchEntity($horarioBarbero, $this->request->getData());
            if ($this->HorarioBarbero->save($horarioBarbero)) {
                $this->Flash->success(__('The horario barbero has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horario barbero could not be saved. Please, try again.'));
        }
        $barbero = $this->HorarioBarbero->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('horarioBarbero', 'barbero'));
    }

    public function agregar()
    {
        $this->loadModel('HorarioBarbero');
        $horarioBarbero = $this->HorarioBarbero->newEmptyEntity();
        if ($this->request->is('post')) {
            $horarioBarbero = $this->HorarioBarbero->patchEntity($horarioBarbero, $this->request->getData());
            if ($this->HorarioBarbero->save($horarioBarbero)) {
                $this->Flash->success(__('The horario barbero has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horario barbero could not be saved. Please, try again.'));
        }
        $barbero = $this->HorarioBarbero->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('horarioBarbero', 'barbero'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Horario Barbero id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $horarioBarbero = $this->HorarioBarbero->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $horarioBarbero = $this->HorarioBarbero->patchEntity($horarioBarbero, $this->request->getData());
            if ($this->HorarioBarbero->save($horarioBarbero)) {
                $this->Flash->success(__('The horario barbero has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The horario barbero could not be saved. Please, try again.'));
        }
        $barbero = $this->HorarioBarbero->Barbero->find('list', ['limit' => 200])->all();
        $this->set(compact('horarioBarbero', 'barbero'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Horario Barbero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $horarioBarbero = $this->HorarioBarbero->get($id);
        if ($this->HorarioBarbero->delete($horarioBarbero)) {
            $this->Flash->success(__('The horario barbero has been deleted.'));
        } else {
            $this->Flash->error(__('The horario barbero could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
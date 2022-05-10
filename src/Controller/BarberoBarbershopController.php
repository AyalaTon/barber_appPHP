<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BarberoBarbershop Controller
 *
 * @property \App\Model\Table\BarberoBarbershopTable $BarberoBarbershop
 * @method \App\Model\Entity\BarberoBarbershop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BarberoBarbershopController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Barbero', 'Barbershop'],
        ];
        $barberoBarbershop = $this->paginate($this->BarberoBarbershop);

        $this->set(compact('barberoBarbershop'));
    }

    /**
     * View method
     *
     * @param string|null $id Barbero Barbershop id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $barberoBarbershop = $this->BarberoBarbershop->get($id, [
            'contain' => ['Barbero', 'Barbershop'],
        ]);

        $this->set(compact('barberoBarbershop'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $barberoBarbershop = $this->BarberoBarbershop->newEmptyEntity();
        if ($this->request->is('post')) {
            $barberoBarbershop = $this->BarberoBarbershop->patchEntity($barberoBarbershop, $this->request->getData());
            if ($this->BarberoBarbershop->save($barberoBarbershop)) {
                $this->Flash->success(__('The barbero barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbero barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->BarberoBarbershop->Barbero->find('list', ['limit' => 200])->all();
        $barbershop = $this->BarberoBarbershop->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('barberoBarbershop', 'barbero', 'barbershop'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Barbero Barbershop id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $barberoBarbershop = $this->BarberoBarbershop->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $barberoBarbershop = $this->BarberoBarbershop->patchEntity($barberoBarbershop, $this->request->getData());
            if ($this->BarberoBarbershop->save($barberoBarbershop)) {
                $this->Flash->success(__('The barbero barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbero barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->BarberoBarbershop->Barbero->find('list', ['limit' => 200])->all();
        $barbershop = $this->BarberoBarbershop->Barbershop->find('list', ['limit' => 200])->all();
        $this->set(compact('barberoBarbershop', 'barbero', 'barbershop'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Barbero Barbershop id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $barberoBarbershop = $this->BarberoBarbershop->get($id);
        if ($this->BarberoBarbershop->delete($barberoBarbershop)) {
            $this->Flash->success(__('The barbero barbershop has been deleted.'));
        } else {
            $this->Flash->error(__('The barbero barbershop could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

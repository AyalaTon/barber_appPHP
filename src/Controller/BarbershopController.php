<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Barbershop Controller
 *
 * @property \App\Model\Table\BarbershopTable $Barbershop
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
            if ($this->Barbershop->save($barbershop)) {
                $this->Flash->success(__('The barbershop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The barbershop could not be saved. Please, try again.'));
        }
        $barbero = $this->Barbershop->Barbero->find('list', ['limit' => 200])->all();
        $barberoLogeado = (int)$_SESSION['Auth']['id'];
        $this->set(compact('barbershop', 'barbero','barberoLogeado'));
    }
}

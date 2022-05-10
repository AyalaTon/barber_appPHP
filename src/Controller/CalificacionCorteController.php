<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CalificacionCorte Controller
 *
 * @property \App\Model\Table\CalificacionCorteTable $CalificacionCorte
 * @method \App\Model\Entity\CalificacionCorte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CalificacionCorteController extends AppController
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
        $calificacionCorte = $this->paginate($this->CalificacionCorte);

        $this->set(compact('calificacionCorte'));
    }

    /**
     * View method
     *
     * @param string|null $id Calificacion Corte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $calificacionCorte = $this->CalificacionCorte->get($id, [
            'contain' => ['Cliente', 'Corte'],
        ]);

        $this->set(compact('calificacionCorte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $calificacionCorte = $this->CalificacionCorte->newEmptyEntity();
        if ($this->request->is('post')) {
            $calificacionCorte = $this->CalificacionCorte->patchEntity($calificacionCorte, $this->request->getData());
            if ($this->CalificacionCorte->save($calificacionCorte)) {
                $this->Flash->success(__('The calificacion corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calificacion corte could not be saved. Please, try again.'));
        }
        $cliente = $this->CalificacionCorte->Cliente->find('list', ['limit' => 200])->all();
        $corte = $this->CalificacionCorte->Corte->find('list', ['limit' => 200])->all();
        $this->set(compact('calificacionCorte', 'cliente', 'corte'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Calificacion Corte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $calificacionCorte = $this->CalificacionCorte->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calificacionCorte = $this->CalificacionCorte->patchEntity($calificacionCorte, $this->request->getData());
            if ($this->CalificacionCorte->save($calificacionCorte)) {
                $this->Flash->success(__('The calificacion corte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calificacion corte could not be saved. Please, try again.'));
        }
        $cliente = $this->CalificacionCorte->Cliente->find('list', ['limit' => 200])->all();
        $corte = $this->CalificacionCorte->Corte->find('list', ['limit' => 200])->all();
        $this->set(compact('calificacionCorte', 'cliente', 'corte'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Calificacion Corte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $calificacionCorte = $this->CalificacionCorte->get($id);
        if ($this->CalificacionCorte->delete($calificacionCorte)) {
            $this->Flash->success(__('The calificacion corte has been deleted.'));
        } else {
            $this->Flash->error(__('The calificacion corte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

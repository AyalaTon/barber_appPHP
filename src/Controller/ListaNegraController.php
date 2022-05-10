<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ListaNegra Controller
 *
 * @property \App\Model\Table\ListaNegraTable $ListaNegra
 * @method \App\Model\Entity\ListaNegra[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListaNegraController extends AppController
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
        $listaNegra = $this->paginate($this->ListaNegra);

        $this->set(compact('listaNegra'));
    }

    /**
     * View method
     *
     * @param string|null $id Lista Negra id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listaNegra = $this->ListaNegra->get($id, [
            'contain' => ['Barbero', 'Cliente'],
        ]);

        $this->set(compact('listaNegra'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $listaNegra = $this->ListaNegra->newEmptyEntity();
        if ($this->request->is('post')) {
            $listaNegra = $this->ListaNegra->patchEntity($listaNegra, $this->request->getData());
            if ($this->ListaNegra->save($listaNegra)) {
                $this->Flash->success(__('The lista negra has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lista negra could not be saved. Please, try again.'));
        }
        $barbero = $this->ListaNegra->Barbero->find('list', ['limit' => 200])->all();
        $cliente = $this->ListaNegra->Cliente->find('list', ['limit' => 200])->all();
        $this->set(compact('listaNegra', 'barbero', 'cliente'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lista Negra id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listaNegra = $this->ListaNegra->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listaNegra = $this->ListaNegra->patchEntity($listaNegra, $this->request->getData());
            if ($this->ListaNegra->save($listaNegra)) {
                $this->Flash->success(__('The lista negra has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lista negra could not be saved. Please, try again.'));
        }
        $barbero = $this->ListaNegra->Barbero->find('list', ['limit' => 200])->all();
        $cliente = $this->ListaNegra->Cliente->find('list', ['limit' => 200])->all();
        $this->set(compact('listaNegra', 'barbero', 'cliente'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lista Negra id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listaNegra = $this->ListaNegra->get($id);
        if ($this->ListaNegra->delete($listaNegra)) {
            $this->Flash->success(__('The lista negra has been deleted.'));
        } else {
            $this->Flash->error(__('The lista negra could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

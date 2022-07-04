<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

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
        $this->loadModel('HorarioBarbero');
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

            // set values to horario barbero
            // $horarioBarbero = $this->HorarioBarbero->newEmptyEntity();
            // exit;

            if ($this->request->getData()['dias'] == 0) {

                $horaDesde = new FrozenTime($this->request->getData('hora_inicio'));
                $horaHasta = new FrozenTime($this->request->getData('hora_fin'));

                try {
                    while ($horaDesde != $horaHasta) {
                        $horarioBarbero = $this->HorarioBarbero->newEmptyEntity();
                        $horarioBarbero->barbero_id = $_SESSION['Auth']['id'];
                        $horarioBarbero->fecha = $this->request->getData('fecha_desde');
                        $horarioBarbero->hora_inicio = $horaDesde->format('H:i:s');
                        $horaDesde = $horaDesde->modify('+30 minutes');
                        $horarioBarbero->hora_fin = $horaDesde->format('H:i:s');
                        $horarioBarbero->disponible = true;
                        $this->HorarioBarbero->save($horarioBarbero);
                    }
                    $this->Flash->success(__('El horario se ha guardado correctamente.'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Exception $e) {
                    $this->Flash->error(__('Los horarios no se pudieron guardar. Por favor, intente nuevamente.'));
                }
            } else if ($this->request->getData()['dias'] == 1 || $this->request->getData()['dias'] == 2 || $this->request->getData()['dias'] == 3) {
                $fechaDesde = new FrozenDate($this->request->getData('fecha_desde'));
                $fechaHasta = new FrozenDate($this->request->getData('fecha_hasta'));
                $horaDesde = new FrozenTime($this->request->getData('hora_inicio'));
                $horaHasta = new FrozenTime($this->request->getData('hora_fin'));

                try {
                    while ($fechaDesde <= $fechaHasta) {
                        $hora_desde_w = $horaDesde;
                        while ($hora_desde_w != $horaHasta) {
                            $horarioBarbero = $this->HorarioBarbero->newEmptyEntity();
                            $horarioBarbero->barbero_id = $_SESSION['Auth']['id'];
                            $horarioBarbero->fecha = $fechaDesde;
                            $horarioBarbero->hora_inicio = $hora_desde_w->format('H:i:s');
                            $hora_desde_w = $hora_desde_w->modify('+30 minutes');
                            $horarioBarbero->hora_fin = $hora_desde_w->format('H:i:s');
                            $horarioBarbero->disponible = true;
                            $this->HorarioBarbero->save($horarioBarbero);
                        }
                        $fechaDesde = $fechaDesde->modify('+1 day');
                    }
                    $this->Flash->success(__('Los horarios se han guardado correctamente.'));
                    return $this->redirect(['action' => 'index']);
                } catch (\Exception $e) {
                    $this->Flash->error(__('Los horarios no se pudieron guardar. Por favor, intente nuevamente.'));
                }
            } else {
                return $this->redirect(['action' => 'index']);
            }
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
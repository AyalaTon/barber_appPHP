<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\HorarioBarbero;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

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
            // debug($this->request->getData());


            // $reserva = $this->Reserva->patchEntity($reserva, $this->request->getData());
            $fecha_corte = $this->request->getData()['fecha_corte'];
            $boton_presionado = $this->request->getData()['boton_presionado'];
            $boton_presionado = (int)$boton_presionado;
            $arreglo_horarios_update = $this->request->getData()[$boton_presionado];
            $horario_inicio = $this->request->getData()['h_i' . $boton_presionado];
            $id_cliente = (int) $_SESSION['Auth']['id'];
            $id_corte = (int) $id_corte;


            $fecha = new FrozenDate($fecha_corte);
            $hora = $horario_inicio; //new FrozenTime($horario_inicio);
            $fecha_actual = FrozenTime::now()->i18nFormat('yyyy-MM-dd');


            $reserva->cliente_id = $id_cliente;
            $reserva->corte_id = $id_corte;
            $reserva->fecha_corte = $fecha;
            $reserva->hora_comienzo_corte = $hora;
            $reserva->fecha_reserva = $fecha_actual;


            $arreglo_horarios_update_array = explode(",", $arreglo_horarios_update);

            foreach ($arreglo_horarios_update_array as $horario) {

                $hora_a_modificar = $this->Reserva->Corte->Barbero->HorarioBarbero->findById((int)$horario)->first();
                // debug($hora_a_modificar);
                // exit;
                $hora_a_modificar->disponible = false;
                $this->Reserva->Corte->Barbero->HorarioBarbero->save($hora_a_modificar);
            }


            // debug([$fecha_corte, $arreglo_horarios_update, $horario_inicio, $id_cliente, $id_corte]);
            // exit;
            if ($this->Reserva->save($reserva)) {
                $this->Flash->success(__('La reserva fue realizada con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La reserva no pudo ser realizada con éxito. Por favor, intente nuevamente.'));
        }
        $corte = $this->Reserva->Corte->findById($id_corte)->toArray()[0];
        $horarios = $this->Reserva->Corte->Barbero->HorarioBarbero->find('all', [
            'conditions' => ['HorarioBarbero.barbero_id =' => $corte['barbero_id'], 'HorarioBarbero.disponible =' => 1],
        ])->toArray();
        // debug($corte);
        // debug($horarios);
        // exit;
        $this->set(compact('reserva', 'corte', 'horarios'));
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
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbero $barbero
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Barbero'), ['action' => 'edit', $barbero->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Barbero'), ['action' => 'delete', $barbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbero->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Barbero'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Barbero'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barbero view content">
            <h3><?= h($barbero->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= h($barbero->usuario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($barbero->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($barbero->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Clave') ?></th>
                    <td><?= h($barbero->clave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imagen Perfil') ?></th>
                    <td><?= h($barbero->imagen_perfil) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tel') ?></th>
                    <td><?= h($barbero->tel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($barbero->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Barbershop') ?></h4>
                <?php if (!empty($barbero->barbershop)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Direccion') ?></th>
                            <th><?= __('Tel') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Website') ?></th>
                            <th><?= __('Habilitado') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbero->barbershop as $barbershop) : ?>
                        <tr>
                            <td><?= h($barbershop->id) ?></td>
                            <td><?= h($barbershop->nombre) ?></td>
                            <td><?= h($barbershop->direccion) ?></td>
                            <td><?= h($barbershop->tel) ?></td>
                            <td><?= h($barbershop->email) ?></td>
                            <td><?= h($barbershop->website) ?></td>
                            <td><?= h($barbershop->habilitado) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Barbershop', 'action' => 'view', $barbershop->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Barbershop', 'action' => 'edit', $barbershop->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Barbershop', 'action' => 'delete', $barbershop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbershop->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Calificacion Cliente') ?></h4>
                <?php if (!empty($barbero->calificacion_cliente)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Calificacion') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbero->calificacion_cliente as $calificacionCliente) : ?>
                        <tr>
                            <td><?= h($calificacionCliente->id) ?></td>
                            <td><?= h($calificacionCliente->barbero_id) ?></td>
                            <td><?= h($calificacionCliente->cliente_id) ?></td>
                            <td><?= h($calificacionCliente->calificacion) ?></td>
                            <td><?= h($calificacionCliente->descripcion) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'CalificacionCliente', 'action' => 'view', $calificacionCliente->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'CalificacionCliente', 'action' => 'edit', $calificacionCliente->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CalificacionCliente', 'action' => 'delete', $calificacionCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $calificacionCliente->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Corte') ?></h4>
                <?php if (!empty($barbero->corte)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Imagen') ?></th>
                            <th><?= __('Precio') ?></th>
                            <th><?= __('Tiempo Estimado') ?></th>
                            <th><?= __('Tipo') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbero->corte as $corte) : ?>
                        <tr>
                            <td><?= h($corte->id) ?></td>
                            <td><?= h($corte->barbero_id) ?></td>
                            <td><?= h($corte->nombre) ?></td>
                            <td><?= h($corte->descripcion) ?></td>
                            <td><?= h($corte->imagen) ?></td>
                            <td><?= h($corte->precio) ?></td>
                            <td><?= h($corte->tiempo_estimado) ?></td>
                            <td><?= h($corte->tipo) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Corte', 'action' => 'view', $corte->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Corte', 'action' => 'edit', $corte->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Corte', 'action' => 'delete', $corte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $corte->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Horario Barbero') ?></h4>
                <?php if (!empty($barbero->horario_barbero)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Hora Inicio') ?></th>
                            <th><?= __('Hora Fin') ?></th>
                            <th><?= __('Disponible') ?></th>
                            <th><?= __('Turno') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbero->horario_barbero as $horarioBarbero) : ?>
                        <tr>
                            <td><?= h($horarioBarbero->id) ?></td>
                            <td><?= h($horarioBarbero->barbero_id) ?></td>
                            <td><?= h($horarioBarbero->fecha) ?></td>
                            <td><?= h($horarioBarbero->hora_inicio) ?></td>
                            <td><?= h($horarioBarbero->hora_fin) ?></td>
                            <td><?= h($horarioBarbero->disponible) ?></td>
                            <td><?= h($horarioBarbero->turno) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'HorarioBarbero', 'action' => 'view', $horarioBarbero->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'HorarioBarbero', 'action' => 'edit', $horarioBarbero->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'HorarioBarbero', 'action' => 'delete', $horarioBarbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $horarioBarbero->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Lista Negra') ?></h4>
                <?php if (!empty($barbero->lista_negra)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbero Id') ?></th>
                            <th><?= __('Cliente Id') ?></th>
                            <th><?= __('Descripcion') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbero->lista_negra as $listaNegra) : ?>
                        <tr>
                            <td><?= h($listaNegra->id) ?></td>
                            <td><?= h($listaNegra->barbero_id) ?></td>
                            <td><?= h($listaNegra->cliente_id) ?></td>
                            <td><?= h($listaNegra->descripcion) ?></td>
                            <td><?= h($listaNegra->estado) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ListaNegra', 'action' => 'view', $listaNegra->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ListaNegra', 'action' => 'edit', $listaNegra->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ListaNegra', 'action' => 'delete', $listaNegra->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listaNegra->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

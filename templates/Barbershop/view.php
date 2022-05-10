<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Barbershop'), ['action' => 'edit', $barbershop->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Barbershop'), ['action' => 'delete', $barbershop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbershop->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Barbershop'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Barbershop'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="barbershop view content">
            <h3><?= h($barbershop->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($barbershop->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Direccion') ?></th>
                    <td><?= h($barbershop->direccion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tel') ?></th>
                    <td><?= h($barbershop->tel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($barbershop->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Website') ?></th>
                    <td><?= h($barbershop->website) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($barbershop->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Habilitado') ?></th>
                    <td><?= h($barbershop->habilitado) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Barbero') ?></h4>
                <?php if (!empty($barbershop->barbero)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Nombre') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Clave') ?></th>
                            <th><?= __('Imagen Perfil') ?></th>
                            <th><?= __('Tel') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbershop->barbero as $barbero) : ?>
                        <tr>
                            <td><?= h($barbero->id) ?></td>
                            <td><?= h($barbero->usuario) ?></td>
                            <td><?= h($barbero->nombre) ?></td>
                            <td><?= h($barbero->email) ?></td>
                            <td><?= h($barbero->clave) ?></td>
                            <td><?= h($barbero->imagen_perfil) ?></td>
                            <td><?= h($barbero->tel) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Barbero', 'action' => 'view', $barbero->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Barbero', 'action' => 'edit', $barbero->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Barbero', 'action' => 'delete', $barbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbero->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Publicacion') ?></h4>
                <?php if (!empty($barbershop->publicacion)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Barbershop Id') ?></th>
                            <th><?= __('Contenido') ?></th>
                            <th><?= __('Imagen') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($barbershop->publicacion as $publicacion) : ?>
                        <tr>
                            <td><?= h($publicacion->id) ?></td>
                            <td><?= h($publicacion->barbershop_id) ?></td>
                            <td><?= h($publicacion->contenido) ?></td>
                            <td><?= h($publicacion->imagen) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Publicacion', 'action' => 'view', $publicacion->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Publicacion', 'action' => 'edit', $publicacion->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Publicacion', 'action' => 'delete', $publicacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publicacion->id)]) ?>
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

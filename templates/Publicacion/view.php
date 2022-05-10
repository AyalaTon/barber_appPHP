<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion $publicacion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Publicacion'), ['action' => 'edit', $publicacion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Publicacion'), ['action' => 'delete', $publicacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publicacion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Publicacion'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Publicacion'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="publicacion view content">
            <h3><?= h($publicacion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Barbershop') ?></th>
                    <td><?= $publicacion->has('barbershop') ? $this->Html->link($publicacion->barbershop->id, ['controller' => 'Barbershop', 'action' => 'view', $publicacion->barbershop->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Contenido') ?></th>
                    <td><?= h($publicacion->contenido) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imagen') ?></th>
                    <td><?= h($publicacion->imagen) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($publicacion->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

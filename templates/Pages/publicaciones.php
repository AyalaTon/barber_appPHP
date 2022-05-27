<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion[]|\Cake\Collection\CollectionInterface $publicacion
 */
?>
<div class="barbero form">
    <?= $this->Flash->render() ?>
    <h3>Publicaciones</h3>
</div>
<div class="publicacion index content">
    <?= $this->Html->link(__('New Publicacion'), array('controller' => 'Publicacion', 'action' => 'add'), ['class' => 'button float-right boton_cerrar'])?>
    <h3><?= __('Publicacion') ?></h3>
    <div class="table-responsive">
        <table>
        </table>
    </div>
    <div class="paginator">
        
    </div>
</div>
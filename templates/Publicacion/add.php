<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publicacion $publicacion
 * @var \Cake\Collection\CollectionInterface|string[] $barbershop
 */
// debug($_SESSION['Auth']);
// debug($barberoLogeado);
// debug($barbero2);
// debug($barbershop);
// debug($this->$_SESSION);
?>
<div class="row">
    <div class="column-responsive">
        <div class="publicacion form content">
            <?= $this->Form->create($publicacion, ['type'=>'file']) ?>
            <fieldset>
                <legend><?= __('Add Publicacion') ?></legend>
                <?php
                    echo $this->Form->control('contenido');
                    echo $this->Form->control('imagen',['type'=>'file']);
                    ?>
                <div hidden>
                    <?php
                    echo $this->Form->control('barbershop_id', ['options' => $barbershop, 'default' => $barbershopDeBarberoLogeado]);
                    ?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

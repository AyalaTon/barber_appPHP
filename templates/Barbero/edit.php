<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbero $barbero
 * @var string[]|\Cake\Collection\CollectionInterface $barbershop
 */
if ($this->request->getAttributes()['identity'] != null) {
    $user_data = $_SESSION['Auth'];
    $image_url = '/img/perfil/' . $user_data['imagen_perfil'];
}

?>

<?= $this->Html->css(['mi_perfil']) ?>
<?php echo $this->Html->script('webroot\js\ocultar_contraseña.js'); ?>

<div class="row">

    <div class="column-responsive ">
        <div class="barbero form content">
            <?= $this->Form->create($barbero, ['type' => 'file']) ?>
            <fieldset>
                <legend></legend>

                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="img-foto-usuario" width="150px" src="<?= $image_url ?>">
                        <span class="font-weight-bold"></span>
                        <span class="text-black-50"></span><span></span>
                    </div>
                </div>

                <?php
                echo $this->Form->control('usuario');
                echo $this->Form->control('nombre');
                echo $this->Form->control('email');

                echo $this->Form->control('imagen_perfil', ['type' => 'file', 'label' => 'Imagen de Perfil', 'required' => true]);
                echo $this->Form->control('tel');
                ?>
                <div hidden>
                    <?php
                    echo $this->Form->control('clave');
                    echo $this->Form->control('barbershop._ids', ['options' => $barbershop]);
                    ?>
                </div>
            </fieldset>

            <?= $this->Html->link(__('Cancelar'), ['action' => 'mi_perfil', $barbero->id], ['class' => 'button']) ?>

            <?= $this->Form->button(__('Guardar cambios')) ?>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
</div>


</div>
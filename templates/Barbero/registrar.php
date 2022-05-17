<br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Registrar</h2>
        <?= $this->Form->create($barbero, ['type' => 'file']) ?>
        <fieldset>
            <legend>Registrar Barbero</legend>
            <?php
            echo $this->Form->control('usuario');
            echo $this->Form->control('nombre');
            echo $this->Form->control('email');
            echo $this->Form->control('clave', ['type' => 'password']);
            echo $this->Form->control('confirmar_clave', ['type' => 'password']);
            echo $this->Form->control('imagen_perfil', ['type' => 'file']);
            echo $this->Form->control('tel');
            ?>
            <div hidden>
                <?php
                echo $this->Form->control('barbershop._ids', ['options' => $barbershop]);
                ?>
            </div>

            <?php echo $this->Form->submit('Registrar', array('class' => 'button'));?>

        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>
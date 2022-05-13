<br>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">Registrar</h2>
        <?= $this->Form->create($cliente, ['type'=>'file']) ?>
        <fieldset>
            <legend>Registrar Cliente</legend>
            <?php
            echo $this->Form->control('usuario');
            echo $this->Form->control('nombre');
            echo $this->Form->control('email');
            echo $this->Form->control('clave');
            echo $this->Form->control('imagen_perfil',['type'=>'file']);
            echo $this->Form->control('tel');
            echo $this->Form->submit('Registrar', array('class'=>'button'));
            ?>
        </fieldset>
        <?= $this->Form->end() ?>
    </div>
</div>
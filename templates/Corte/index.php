<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Corte[]|\Cake\Collection\CollectionInterface $corte
 */
?>
<?php
$isTheme = isset($_COOKIE["theme"]);
if ($isTheme) {
    if ($_COOKIE["theme"] == "dark") {
        $background = "#2a2b2e";
        $background2 = "#34373B";
        $color = "#fff";
    } else {
        $background = "#f5f7fa";
        $background2 = "#f9f9f9";
        $color = "#363637";
    }
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<div class="corte index content" style="background-color: <?php echo $background2; ?>!important;">
    <?= $this->Html->link(__('Nuevo Corte'), ['action' => 'agregar'], ['class' => 'button float-right']) ?>
    <h3 style="color: <?php echo $color; ?> !important; "><?= __('Corte') ?></h3>
    <div class="table-responsive">
        <table style="color: <?php echo $color; ?> !important; ">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Tiempo estimado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($corte as $corte) : ?>
                <?php
                    if ($corte->barbero->id == $barberoLogeado) { // MUESTRA SOLO LOS CORTES DEL BARBERO ACTUAL
                    ?>
                <tr>
                    <td><?= h($corte->nombre) ?></td>
                    <td>
                        <div class="modulee line-clamp">
                            <p> <?= h($corte->descripcion) ?> </p>
                        </div>
                    </td>
                    <td> <img class="zoom" src='<?= h($corte->imagen) ?>'></td>
                    <td><?= $this->Number->format($corte->precio) ?></td>
                    <td><?= h($corte->tiempo_estimado) ?></td>
                </tr>
                <?php
                    }
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>
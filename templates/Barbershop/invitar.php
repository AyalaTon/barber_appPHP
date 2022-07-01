<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barbershop $barbershop
 * @var \Cake\Collection\CollectionInterface|string[] $barbero
 */
?>
<?php
if ($_COOKIE["theme"] == "dark") {
    $background = "#2a2b2e";
    $background2 = "#121316";
    $color = "#fff";
} else {
    $background = "#f5f7fa";
    $background2 = "#f9f9f9";
    $color = "#363637";
}
?>
<input style="color: <?php echo $color; ?> !important; " type="text" id="myInput" onkeyup="buscador()"
    placeholder="Filtrar por nombre">
<div class="row">
    <div class="column-responsive">
        <table style="color: <?php echo $color; ?> !important; " id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Invitar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barberosSinBarberias as $barberoSinBarberia) { ?>
                <tr>
                    <td><?= $barberoSinBarberia->id ?></td>
                    <td><?= $barberoSinBarberia->usuario ?></td>
                    <td><?= $barberoSinBarberia->nombre ?></td>
                    <td>
                        <img alt="<?php echo $barberoSinBarberia->nombre ?>"
                            src="<?php echo '/img/perfil/' . $barberoSinBarberia->imagen_perfil ?>"
                            class="img_perfil" />
                    </td>
                    <td>

                        <?=
                            $this->Html->link('Invitar', array(
                                'controller' => 'BarberoBarbershop',
                                'action' => 'barberoInvitado',
                                $barberoSinBarberia->id,
                            ));

                            ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>


    </div>
</div>

<script>
function buscador() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
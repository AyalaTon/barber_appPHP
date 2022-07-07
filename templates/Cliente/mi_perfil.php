<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */

if ($this->request->getAttributes()['identity'] != null) {
    $user_data = $_SESSION['Auth'];
    $image_url = '/img/perfil/' . $user_data['imagen_perfil'];
}
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
<?= $this->Html->css(['mi_perfil']) ?>
<?php echo $this->Html->script('webroot\js\ocultar_contraseña.js'); ?>


<div class="row">

    <div class="column-responsive ">
        <div class="cliente view content" style="background-color: <?php echo $background2; ?>!important;">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="img-foto-usuario"
                        width="150px" src="<?= $image_url ?>">
                    <span class="font-weight-bold"> </span>
                    <span class="text-black-50"> </span><span></span>
                </div>

            </div>


            <div class="col-md-5 border-right" style="color: <?php echo $color; ?> !important; ">
                <div class="p-3 py-5">
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Nombre</label><input
                                style="color: <?php echo $color; ?> !important; " type="text" class="form-control"
                                value="<?= h($cliente->nombre) ?>" placeholder="surname"></div>
                        <div class="col-md-6"><label class="labels">Usuario</label><input
                                style="color: <?php echo $color; ?> !important; " type="text" class="form-control"
                                placeholder="first name" value="<?= h($cliente->usuario) ?>"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Tel</label><input
                                style="color: <?php echo $color; ?> !important; " type="text" class="form-control"
                                placeholder="enter phone number" value="<?= h($cliente->tel) ?>"></div>
                    </div>

                </div>
            </div>

            <div class="editar-datos-login">
                <div class="p-3 py-5">
                    <div class="col-md-12"><label class="labels">Email</label><input
                            style="color: <?php echo $color; ?> !important; " type="text" class="form-control"
                            placeholder="experience" value="<?= h($cliente->email) ?>">
                    </div> <br>
                </div>
            </div>
            <?= $this->Html->link(__('Edit Cliente'), ['action' => 'edit', $cliente->id], ['class' => 'button']) ?>

        </div>
    </div>
</div>

<script>
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function() {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the icon
    this.classList.toggle("bi-eye");
});

// prevent form submit
const form = document.querySelector("form");
form.addEventListener('submit', function(e) {
    e.preventDefault();
});
</script>
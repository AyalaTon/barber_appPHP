<?php 
/**
 * @var \App\mi_perfil\AppView $this
 * @var \App\Model\Entity\Barbero $barbero

 */


?>

<?= $this->Html->css(['mi_perfil']) ?>
<?php echo $this->Html->script('webroot\js\ocultar_contraseña.js'); ?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Barbero'), ['action' => 'edit', $barbero->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Barbero'), ['action' => 'delete', $barbero->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barbero->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Barbero'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Barbero'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="css/style.css" />
        </div>



    </aside>
    <div class="column-responsive column-80">
        <div class="barbero view content">
  

            
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">Edogaru</span>
                    <span class="text-black-50">edogaru@mail.com.my</span><span></span>
                </div>
           
            </div>
    
                    
            <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><input type="text" class="form-control" value="<?= h($barbero->nombre) ?>" placeholder="surname"></div>
                    <div class="col-md-6"><label class="labels">Usuario</label><input type="text" class="form-control" placeholder="first name" value="<?= h($barbero->usuario) ?>"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Tel</label><input type="text" class="form-control" placeholder="enter phone number" value="<?= h($barbero->tel) ?>"></div>
                </div>
              
            </div>
        </div>

        <div class ="editar-datos-login">
            <div class="p-3 py-5">
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="experience" value="<?= h($barbero->email) ?>"></div> <br>
                    <div class="col-md-12"><label class="labels" id="password">Contraseña</label><input type="password" class="form-control" placeholder="additional details" value="<?= h($barbero->clave) ?>"> <i class="bi bi-eye-slash" id="togglePassword"></i></div>
            </div>                
        </div>  

        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>

        </div>
    </div>
</div>

<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
    </script>
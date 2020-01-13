<!--Page Header-->
<section class="page-header profile_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Espace Client</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a>
                <li>Espace Client</li>
            </ul>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--demande-special-->
<section class="contact_us section-padding">
    <div class="container">
        <div  class="row">
            <div class="col-md-offset-2 col-md-8">
                <h3 style="text-align: center;">Créez votre espace client</h3>
                <div class="contact_Form gray-bg">
                <?= $this->Form->create($new_user); ?>
                    <div class="form-group">
                        <?= $this->Form->input('FirstName', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Nom*',
                            'label' => 'Nom',
                            'required',
                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('LastName', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Prenom',
                            'label' => 'Prénom',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('ContactNo', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Téléphone*',
                            'label' => 'Téléphone',
                            'maxlength' => '10',
                            'required'
                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Email', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'abc@xyz.com*',
                            'label' => 'Email',
                            'onBlur' => 'checkAvailability()',
                            'required',
                        )); ?>
                        <span id="user-availability-status" style="font-size:12px;"></span>
                    </div>
                    <div class="form-group">
                        <label class="Form-label">Date de Naissance </label>
                        <div class="select">
                            <input type="date" class="form-control white_bg" name="BornDate" placeholder="Date de naissance*" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Address', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Adresse',
                            'label' => 'Adresse',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('City', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Ville',
                            'label' => 'Ville',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('ZipCode', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Code Postal',
                            'label' => 'Code Postal',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Province', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Province',
                            'label' => 'Province',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Country', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Pays',
                            'label' => 'Pays',

                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Password', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Mot de Passe*',
                            'type' => 'password',
                            'label' => 'Mot de Passe',
                            'required',
                        )); ?>

                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Password_verify', array(
                            'class' => 'form-control white_bg',
                            'type' => 'password',
                            'placeholder' => 'Confirmer Mot de Passe*',
                            'label' => 'Confirmer Mot de Passe',
                            'required',
                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('S\'enregister', array(
                            'class' => 'btn btn-block',
                            'type'  => 'submit',
                            'label' => ''
                        )); ?>
                    </div>
                <?= $this->Form->end(); ?>
                </div>
                <div class="text-center">
                    <p>Pas de compte? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Connexion</a></p>
                    <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Mot de Passe Oublié ?</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /demande-speciale-->

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "http://transports-citadins.dev/users/check_availability/",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

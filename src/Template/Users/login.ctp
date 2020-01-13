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
                <h3 style="text-align: center;">Connectez-Vous à votre espace client</h3>
                <div class="contact_form gray-bg">
                <?= $this->Form->create('User', ['url' => ['Controller' => 'Users','action' => 'login']]); ?>
                    <div class="form-group">
                        <?= $this->Form->input('Email', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Email',
                            'type' => 'text',
                            'label' => 'Email',
                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Password', array(
                            'class' => 'form-control white_bg',
                            'placeholder' => 'Mot de passe',
                            'type' => 'password',
                            'label' => 'Mot de Passe',
                        )); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('Connexion', array(
                            'class' => 'btn btn-success',
                            'id'    => 'connexion',
                            'type'  => 'submit',
                            'label' => ''
                        )); ?>
                    </div>
                <?= $this->Form->end(); ?>
                </div>
                <div class="text-center">
                    <p>Pas de compte? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'signup']) ?>">Enregistrement</a></p>
                    <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Mot de Passe Oublié ?</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /demande-speciale-->

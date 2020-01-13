<!--Page Header-->
<section class="page-header contactus_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Demande Spéciale</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a>
                <li>Demande Spéciale</li>
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
                <h3 style="text-align: center;">Faites Votre Demande À LTC</h3>
                <div class="contact_form gray-bg">
                    <?= $this->Form->create($demandeSpeciale, ['url' => ['controller' => 'Transports', 'action' => 'demandeSpeciale']]) ?>
                        <div class="form-group">
                            <?= $this->Form->input('name', ['class' => 'form-control white_bg', 'label' => 'Nom & Prénom *', 'required']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('email', ['class' => 'form-control white_bg', 'type'=>'email', 'label' => 'Email *', 'required']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('telephone', ['class' => 'form-control white_bg', 'label' => 'Téléphone', 'required']); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('message', ['class' => 'form-control white_bg','type'=>'textarea', 'label' => 'Demande *', 'required']); ?>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Lfatz8UAAAAAIYAPczx6M02vCuHVHth1FYwD3Za"></div>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->input('Envoyer la Demande', array(
                                'class' => 'btn',
                                'type'  => 'submit',
                            )); ?>
                        </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /demande-speciale-->

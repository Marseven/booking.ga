<!--Page Header-->
<section class="page-header contactus_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Réservation Spéciale</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a>
                <li>Réservation Spéciale</li>
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
            <div class=" col-md-12">
                <h3 style="text-align: center;">Faites Votre Réservation Spéciale Aux Transports Citadins</h3>
                <div class="contact_form gray-bg">
                    <?= $this->Form->create($reservationSpeciale, ['url' => ['controller' => 'Transports', 'action' => 'reservationSpeciale']]) ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <?= $this->Form->input('name', ['class' => 'form-control white_bg', 'label' => 'Nom & Prénom *', 'required']); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $this->Form->input('email', ['class' => 'form-control white_bg', 'type'=>'email', 'label' => 'Email *', 'required']); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $this->Form->input('telephone', ['class' => 'form-control white_bg', 'label' => 'Téléphone', 'required']); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $this->Form->input('message', ['class' => 'form-control white_bg','type'=>'textarea', 'rows'=>2, 'label' => 'Description', 'required']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3 col-sm-6">
                            <?= $this->Form->input('lieu_depart', ['type' => 'text', 'class' => 'form-control white_bg', 'label' => 'Lieu de départ *', 'required']); ?>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <?= $this->Form->input('lieu_arriver', ['type' => 'text','class' => 'form-control white_bg', 'label' => 'Lieu d\'Arrivé *', 'required']); ?>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label class="form-label">Date de départ *</label>
                            <div class="select">
                                <input type="text" class="mt10px input form-control white_bg" id="J-demo-03" name="date_depart" placeholder="Date de Départ*" required>
                                <script type="text/javascript">
                                    $('#J-demo-03').dateTimePicker({
                                        mode: 'dateTime',
                                        limitMin: '<?php $date = date('Y-m-d H:m:s'); echo $date; ?>',
                                        limitMax: '2099-12-31 23:59:59'
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label class="form-label">Date d'arrivé *</label>
                            <div class="select">
                                <input type="text" class="mt10px input form-control white_bg" id="J-demo-04" name="date_arriver" placeholder="Date de Retour*" required>
                                <script type="text/javascript">
                                    $('#J-demo-04').dateTimePicker({
                                        mode: 'dateTime',
                                        limitMin: '<?php $date = date('Y-m-d H:m:s'); echo $date; ?>',
                                        limitMax: '2099-12-31 23:59:59'
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <?= $this->form->input('voiture', array(
                                'options' => $vehicules,
                                'class' => 'form-control white_bg',
                                'label' => 'Voiture',
                            )); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="g-recaptcha" data-sitekey="6Lfatz8UAAAAAIYAPczx6M02vCuHVHth1FYwD3Za"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <?= $this->Form->input('Envoyer', array(
                                'class' => 'btn',
                                'type'  => 'submit',
                            )); ?>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /demande-speciale-->

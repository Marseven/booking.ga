<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Administration > Mise à jour</h4>
            </div>
        </div>
        <?= $this->Flash->render() ?>
        <div class="row">
            <div class="col-md-6">
                <?= $this->form->create($user_edit); ?>

                <?= $this->form->input('last_name', array(
                    'class' => 'form-control',
                    'placeholder' => 'Nom*',
                    'label' => 'Nom',
                )); ?>
                <?= $this->form->input('first_name', array(
                    'class' => 'form-control',
                    'placeholder' => 'Prenom',
                    'label' => 'Prénom',
                )); ?>
                <?= $this->form->input('email', array(
                    'class' => 'form-control',
                    'placeholder' => 'abc@xyz.com*',
                    'label' => 'Email',
                )); ?>
                <?= $this->form->input('phone', array(
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone*',
                    'label' => 'Téléphone',
                )); ?>
                <?= $this->form->input('town', array(
                    'class' => 'form-control',
                    'placeholder' => 'Ville*',
                    'label' => 'Ville',
                )); ?>
                <?= $this->form->input('adress', array(
                    'class' => 'form-control',
                    'placeholder' => 'Adresse',
                    'label' => 'Adresse',
                )); ?>
                <?= $this->form->input('password', array(
                    'class' => 'form-control',
                    'placeholder' => 'Mot de Passe*',
                    'type' => 'password',
                    'label' => 'Mot de Passe',
                )); ?>
                <?= $this->form->input('password_verify', array(
                    'class' => 'form-control',
                    'type' => 'password',
                    'placeholder' => 'Confirmer Mot de Passe*',
                    'label' => 'Confirmer Mot de Passe',
                )); ?>
                <br>
                <div class="clearfix center">
                    <div class="validation">
                        <?= $this->form->input('S\'enregister', array(
                            'class' => 'btn btn-success',
                            'type'  => 'submit',
                            'label' => ''
                        )); ?>
                    </div>
                </div>
                <?= $this->form->end(); ?>
            </div>
        </div>
    </div>
</div>
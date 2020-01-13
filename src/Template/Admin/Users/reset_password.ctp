<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
        <?= $this->Flash->render() ?>
      <div class="col-md-12">
        <h2 class="page-title">Modifier Le Mot de Passe</h2>

        <div class="row">
          <div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading"></div>
              <div class="panel-body">
                  <?= $this->Form->create('User', ['url' => ['action' => 'resetPassword']]); ?>
                  <div class="form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->control('Old_Password', [
                            'class' => 'form-control',
                            'placeholder' => 'Mot de Passe*',
                            'label' => 'Mot de Passe',
                            'type' => 'password',

                        ]); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->control('Password', [
                            'class' => 'form-control',
                            'type' => 'password',
                            'placeholder' => 'Nouveau Mot de Passe*',
                            'label' => 'Nouveau Mot de Passe',
                        ]); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-12">
                        <?= $this->Form->control('Password_verify', [
                            'class' => 'form-control',
                            'type' => 'password',
                            'placeholder' => 'Confirmer Mot de Passe*',
                            'label' => 'Confirmer Mot de Passe',
                        ]); ?>
                        <?= $this->Form->control('Email', [
                            'value' => $user['Email'],
                            'type' => 'hidden',
                        ]); ?>
                    </div>
                      <br><br><br>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-8">
                        <?= $this->Form->control('MODIFIER', [
                            'class' => 'btn btn-sm btn-success',
                            'type'  => 'submit',
                        ]); ?>
                    </div>
                  </div>
                  <?= $this->Form->end(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
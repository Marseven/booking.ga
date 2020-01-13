<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Mis à Jour du Mot de Passe</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
        <li>Mis à jour du mot de passe</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 
<section class="user_profile inner_pages">
  <div class="container">
      <?php if(isset($user)){ ?>
      <div class="user_profile_info gray-bg padding_4x4_40">
        <div class="dealer_info">
            <h5><?php echo htmlentities($user['FirstName']);?> <?php echo htmlentities($user['LastName']);?></h5>
            <p><?php echo htmlentities($user['Address']);?><br>
                <?php echo htmlentities($user['City']);?>&nbsp;<?php echo htmlentities($user['Country']);?></p>
        </div>
    </div>
      <?php } ?>
    <div class="row">
        <?php if(isset($user)){ ?>
      <div class="col-md-3 col-sm-3">
      <div class="profile_nav">
          <ul>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Profil</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword']) ?>">Changer le Mot de passe</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservationList']) ?>">Mes Réservations</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'add']) ?>">Témoigner</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'index']) ?>">Mes Témoignageages</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
          </ul>
        </div>
      </div>
        <?php } ?>
        <div class="col-md-9 col-sm-9">
        <div class="profile_wrap">
        <?= $this->Form->create('User', ['url' => ['action' => 'resetPassword']]); ?>
        
            <div class="gray-bg field-title">
              <h6>Mettre le mot de passe à jour</h6>
            </div>
            <div class="form-group">
            <?= $this->Form->control('Password', [
                'class' => 'form-control',
                'placeholder' => 'Mot de Passe*',
                'label' => 'Mot de Passe',
                'type' => 'password',

            ]); ?>        
            </div>
            <div class="form-group">
            <?= $this->Form->control('Password_verify', [
                'class' => 'form-control',
                'type' => 'password',
                'placeholder' => 'Confirmer Mot de Passe*',
                'label' => 'Confirmer Mot de Passe',
            ]); ?>    
            <?= $this->Form->control('Email', [
                'value' => isset($user) ? $user['Email'] : $email,
                'type' => 'hidden',
            ]); ?>    
            </div>          
            <div class="form-group">
            <?= $this->Form->control('Valider', [
                'class' => 'btn btn-sm btn-success',
                'type'  => 'submit',
            ]); ?>
            </div>
            <?= $this->Form->end(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 
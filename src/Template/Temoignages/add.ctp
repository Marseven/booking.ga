<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Témoignages</h1>
      </div>
      <ul class="coustom-breadcrumb">
      <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
        <li>Témoignages</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<section class="user_profile inner_pages">
  <div class="container">  
    <div class="row">
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
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Faire un témoignage</h5>
          <?= $this->Form->create('Temoignage'); ?>
            <div class="form-group">
            <?= $this->Form->control('Testimonial', [
                'class' => 'form-control',
                'placeholder' => 'Votre témoignage',
                'label' => 'Témoigange',
                'type' => 'textarea',
                'rows' => '4'
            ]); ?>
            <?= $this->Form->control('UserEmail', [
                'value' => $user['id'],
                'type' => 'hidden',
            ]); ?>
            </div>
            <div class="form-group">
              <?= $this->Form->control('Enregistrer', [
                'class' => 'btn',
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
<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Mes Témoignages</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
        <li>Mes Témoignages</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<section class="user_profile inner_pages">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
     <div class="dealer_info">
        <h5><?php echo htmlentities($user['FirstName']);?> <?php echo htmlentities($user['LastName']);?></h5>
        <p><?php echo htmlentities($user['Address']);?><br>
          <?php echo htmlentities($user['City']);?>&nbsp;<?php echo htmlentities($user['Country']);?></p>
      </div>
    </div>
  
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
      <div class="col-md-8 col-sm-8">



        <div class="profile_wrap">
          <h5 class="uppercase underline">Mes Témoignages </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
            <?php foreach($temoignages as $temoignage){ ?>
              <li>
                <div>
                 <p><?php echo htmlentities($temoignage->Testimonial);?> </p>
                   <p><b>Posté le : </b><?php echo htmlentities(\App\Controller\AppController::change_format_date($temoignage->PostingDate));?> </p>
                </div>
                <?php if($temoignage->status == 1){ ?>
                 <div class="vehicle_status"> <a class="btn outline btn-xs active-btn">Actif</a>

                  <div class="clearfix"></div>
                  </div>
                  <?php } else {?>
               <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">En attente de validation</a>
                  <div class="clearfix"></div>
                  </div>
                  <?php } ?>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
          <!--div class="col-lg-12">
              <ul class="pagination">
                <?php echo $this->Paginator->prev('Précédent'); ?>
                <?php echo $this->Paginator->numbers().' ' ; ?>
                <?php echo $this->Paginator->next('Suivant'); ?>
              </ul>
          </div-->
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 
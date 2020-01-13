
<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Mes Réservations</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
        <li>Mes Réservations</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

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
        
      <div class="col-md-9 col-sm-9">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Mes Réservations </h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
            <?php foreach($reservations as $reservation){  ?>
              <li>
                <div class="vehicle_img"> <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $reservation->vehicule->id]) ?>"><img src="/img/admin/img/vehicleimages/<?php echo htmlentities($reservation->vehicule->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">
                  <h6><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $reservation->vehicule->id]) ?>"> <?php echo htmlentities($reservation->vehicule->marque->BrandName);?> , <?php echo htmlentities($reservation->vehicule->VehiclesTitle);?></a></h6>
                  <p><b>Valeur de la réservation:</b> <?php echo htmlentities(\App\Controller\AppController::change_number_format($reservation->Price));?> FCFA<br /></p>
                  <p><b>Date de début:</b> <?php echo htmlentities(\App\Controller\AppController::change_format_date($reservation->FromDate));?><br /> <b>Date de fin:</b> <?php echo htmlentities(\App\Controller\AppController::change_format_date($reservation->ToDate));?>
                  <br/><b>Lieu de départ:</b> <?php echo htmlentities($reservation->FromPlace);?><br /> <b>Lieu d'arriver:</b> <?php echo htmlentities($reservation->ToPlace);?></p>
                  <p><b>Mode de règlement:</b> <?php echo htmlentities($reservation->Payment); ?> </p>
                </div>
                <div class="vehicle_status"> 
                    <a href="#" class="btn outline btn-xs active-btn"><?php echo htmlentities($reservation->Status); ?></a>
                    <div class="clearfix"></div>
                </div>       
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

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Mon Profil</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Accueil</a></li>
        <li>Profil</li>
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
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Paramètres</h5>
          <?= $this->Form->create($user_edit) ?>
           <div class="form-group">
              <label class="control-label">Date d'inscription -</label>
             <?php echo htmlentities(\App\Controller\AppController::change_Format_date($user['RegDate']));?>
            </div>
             <?php if($user['UpdationDate']!=""){?>
            <div class="form-group">
              <label class="control-label">Dernière Mise à Jour  -</label>
             <?php echo htmlentities(\App\Controller\AppController::change_Format_date($user['UpdationDate']));?>
            </div>
            <?php } ?>
            <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('FirstName', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Nom*',
                                        'label' => 'Nom',
                                        'required',
                                    )); ?>
                      </div>  
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('LastName', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Prenom',
                                        'label' => 'Prénom',

                                    )); ?>
                     </div>                      
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('Email', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'abc@xyz.com*',
                                        'label' => 'Email',
                                        'onBlur' => 'checkAvailability()',
                                        'required',
                                    )); ?>
                        <span id="user-availability-status" style="font-size:12px;"></span> 
                      </div>  
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('ContactNo', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Téléphone*',
                                        'label' => 'Téléphone',
                                        'maxlength' => '10',
                                        'required'
                                    )); ?>
                      </div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('Address', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Adresse',
                                        'label' => 'Adresse',

                                    )); ?>
                      </div>  
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('ZipCode', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Code Postal',
                                        'label' => 'Code Postal',

                                    )); ?>                        
                      </div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('City', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Ville',
                                        'label' => 'Ville',

                                    )); ?>
                      </div>  
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('Province', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Province',
                                        'label' => 'Province',

                                    )); ?>
                      </div>    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                      <?= $this->Form->input('Country', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Pays',
                                        'label' => 'Pays',

                                    )); ?>
                      </div>  
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="Form-label">Date de Naissance </label>
                        <div class="select">
                            <input type="date" class="form-control white_bg" name="BornDate" placeholder="Date de naissance*" required>
                        </div>                     
                      </div>  
                    </div>
                  </div>
           
            <div class="form-group">
              <?= $this->Form->input('Mettre à Jour', array(
                        'class' => 'btn btn-success',
                        'type'  => 'submit',
                        'label' => ''
                    )); ?>
            </div>
          </Form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

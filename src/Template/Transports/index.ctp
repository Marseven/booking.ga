<!-- Banners -->
<section id="banner" class="banner-section">
    <div class="container">
        <div class="div_zindex">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner_content">
                        <!-- Filter-Form -->
                        <section id="filter_form2">
                            <div class="container">
                                <div class="main_bg white-text">
                                    <h3>Réserver En Ligne</h3>
                                    <div class="row">
                                        <?= $this->Form->create($search, ['url' => ['controller' => 'Transports', 'action' => 'searchResult']]); ?>
                                            <div class="form-group col-md-3 col-sm-6">
                                                <!--div class="">
                                                    <label class="form-label">Lieu de départ </label>
                                                    <?= $this->Form->input('lieu_depart', array(
                                                        'options' => [
                                                                'Hôtel Le Méridien RE-NDAMA' => 'Hôtel Le Méridien RE-NDAMA',
                                                                'Hôtel Le Cristal' => 'Hôtel Le Cristal'
                                                        ],
                                                        'class' => 'form-control',
                                                        'label' => '',
                                                    )); ?>
                                                </div-->
                                                <label class="form-label">Lieu de départ </label>
                                                <div class="input-group date">
                                                    <select class="form-control" id="lieu_depart" name="lieu_depart">
                                                        <option value="Hôtel Le Méridien RE-NDAMA">Hôtel Le Méridien RE-NDAMA</option>
                                                        <option value="Hôtel Le Cristal">Hôtel Le Cristal</option>
                                                    </select>
                                                    <span class="input-group-addon">
                                                        <a href="#addplace_depart" data-toggle="modal" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6">
                                                <div class="">
                                                    <label class="form-label">Marque </label>
                                                    <?php /*$this->Form->input('marque', array(
                                                        'options' => $marques,
                                                        'class' => 'form-control',
                                                        'label' => '',
                                                    ));*/ ?>
                                                    <select class="form-control" name="marque">
                                                        <?php foreach($marques as $marque){?>
                                                            <option value="<?php echo htmlentities($marque->id);?>"><?php echo htmlentities($marque->BrandName);?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6">
                                                <div class="">
                                                    <label class="form-label">Type de voiture </label>
                                                    <?php /*$this->Form->input('type', array(
                                                        'options' => [
                                                            '4x4 Standard' => '4x4 Standard',
                                                            '4x4 Luxe' => '4x4 Luxe',
                                                            '4x4 Utilitaire' => '4x4 Utilitaire',
                                                            '4x4 Mini' => '4x4 Mini',
                                                            'Bus' => 'Bus',
                                                            'Mini Bus' => 'Mini Bus',
                                                            'Berline Stardard' => 'Berline Stardard',
                                                            'Berline Luxe' => 'Berline Luxe'
                                                        ],
                                                        'class' => 'form-control',
                                                        'label' => '',
                                                    ));*/ ?>
                                                    <select class="form-control" name="type">
                                                        <option>4x4 Standard</option>
                                                        <option>4x4 Luxe</option>
                                                        <option>4x4 Utilitaire</option>
                                                        <option>4x4 Mini</option>
                                                        <option>Bus</option>
                                                        <option>Mini Bus</option>
                                                        <option>Berline Standard</option>
                                                        <option>Berline Luxe</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6">
                                                <!--div class="">
                                                    <label class="form-label">Lieu d'arrivé </label>
                                                    <?= $this->Form->input('lieu_arriver', array(
                                                        'options' => [
                                                            'Hôtel Le Méridien RE-NDAMA' => 'Hôtel Le Méridien RE-NDAMA',
                                                            'Hôtel Le Cristal' => 'Hôtel Le Cristal'
                                                        ],
                                                        'class' => 'form-control',
                                                        'label' => '',
                                                    )); ?>
                                                </div-->
                                                <label class="form-label">Lieu d'arrivé </label>
                                                <div class="input-group date">
                                                    <select class="form-control" id="lieu_arriver" name="lieu_arriver">
                                                        <option value="Hôtel Le Méridien RE-NDAMA">Hôtel Le Méridien RE-NDAMA</option>
                                                        <option value="Hôtel Le Cristal">Hôtel Le Cristal</option>
                                                    </select>
                                                    <span class="input-group-addon">
                                                        <a href="#addplace_arriver" data-toggle="modal" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6">
                                                <label class="form-label">Date de départ </label>
                                                <div class="select">
                                                    <input type="text" class="mt10px input form-control" id="J-demo-03" name="date_depart" placeholder="Date de Départ" required>
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
                                                <label class="form-label">Date d'arrivé </label>
                                                <div class="select">
                                                    <input type="text" class="mt10px input form-control" id="J-demo-04" name="date_arriver" placeholder="Date de Retour" required>
                                                    <script type="text/javascript">
                                                        $('#J-demo-04').dateTimePicker({
                                                            mode: 'dateTime',
                                                            limitMin: '<?php $date = date('Y-m-d H:m:s'); echo $date; ?>',
                                                            limitMax: '2099-12-31 23:59:59'
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label class="form-label">Intervalle de Prix (Francs CFA) </label>
                                                <input id="price_range" name="Prix" type="text" class="span2" value="" data-slider-min="100" data-slider-max="200000" data-slider-step="5" data-slider-value="[5000,300000]"/>
                                            </div>

                                            <div class="form-group col-md-3 col-sm-6">
                                                <?= $this->Form->input('Rechercher', array(
                                                    'class' => 'btn btn-block',
                                                    'type'  => 'submit',
                                                    'name' => 'search',
                                                    'value' => 'accueil',
                                                    'label' => '',
                                                )); ?>
                                            </div>
                                            <?= $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- /Filter-Form -->
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /Banners -->


<!-- Resent Cat-->
<section class="section-padding gray-bg">
    <div class="container">
        <!--div class="section-header text-center">
          <h2>Find the Best <span>CarForYou</span></h2>
          <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
        </div-->
        <div class="row">

            <!-- Nav tabs -->
            <div class="recent-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Nos Véhicules</a></li>
                </ul>
            </div>
            <!-- Recently Listed New Cars -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                    <?php if(!$vehicules->first()){ ?>
                        <div style="text-align: center;" class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            Pas De véhicules pour le moment !
                        </div>
                    <?php } ?>
                    <?php foreach($vehicules as $k => $vehicule){ ?>
                        <div class="col-list-3">
                            <div class="recent-car-list">
                                <div class="car-info-box"> <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?></a>
                                    <ul>
                                        <li><i class="fa fa-tint" aria-hidden="true"></i><?php echo htmlentities($vehicule->FuelType);?></li>
                                        <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</li>
                                        <li><i class="fa fa-cogs" aria-hidden="true"></i> <?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></li>
                                    </ul>
                                </div>
                                <div class="car-title-m">
                                    <h6><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></a></h6>
                                    <br><br><strong><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</strong>
                                    <br><strong><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></strong>
                                </div>
                                <div class="inventory_info_m">
                                    <p><?php echo substr($vehicule->VehiclesOverview,0,70);?>...</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>
<!-- /Resent Cat -->

<!-- Fun Facts
<section class="fun-facts-section">
    <div class="container div_zindex">
        <div class="row">
            <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                    <div class="cell">
                        <h2><i class="fa fa-calendar" aria-hidden="true"></i>7</h2>
                        <p>Ans dans la réservation</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                    <div class="cell">
                        <h2><i class="fa fa-car" aria-hidden="true"></i>0</h2>
                        <p>Nouvelles Voitures</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                    <div class="cell">
                        <h2><i class="fa fa-car" aria-hidden="true"></i>0</h2>
                        <p>Reservations Effectués</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 col-sm-3">
                <div class="fun-facts-m">
                    <div class="cell">
                        <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>0</h2>
                        <p>Clients Satisfaits</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dark Overlay
    <div class="dark-overlay"></div>
</section>
<!-- /Fun Facts-->


<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">
    <div class="container div_zindex">
        <div class="section-header white-text text-center">
            <h2>Nos Clients <span>Satisfaits</span></h2>
        </div>
        <div class="row">
            <div id="testimonial-slider">
                <?php if(!$temoignages->first()){ ?>
                    <div style="text-align: center;" class="col-lg-12 alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        Aucun témoignage pour le moment !
                    </div>
                <?php } ?>
                <?php foreach($temoignages as $k => $temoignage){ ?>
                    <div class="testimonial-m">
                        <div class="testimonial-img"> <?= $this->Html->image("/images/cat-profile.png", ['fullBase' => true, 'alt'=>'image']); ?></div>
                        <div class="testimonial-content">
                            <div class="testimonial-heading">
                                <p><?php echo htmlentities($temoignage->Testimonial);?></p>
                                <h6> <em> - <?php echo htmlentities($temoignage->user->FirstName);?> <?php echo htmlentities($temoignage->user->LastName);?></em></h6>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Testimonial-->

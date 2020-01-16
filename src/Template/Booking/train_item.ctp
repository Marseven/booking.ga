<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <div class="listing_detail_head row">
            <div class="col-md-9" style="margin-bottom: -20px;">
                <div class="row">
                    <div class="col-sm-6">
                        <?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage2, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?>
                    </div>
                </div>
                <br>
                <h2><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></h2>
            </div>
            <div class="col-md-3">
                <div class="price_info">
                    <p style="font-size: 27px;"><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p>
                    <p style="font-size: 27px;"><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="main_features">
                    <ul>
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <p>Avec Chauffeur</p>
                        </li>
                        <li>
                            <i class="fa fa-tint" aria-hidden="true"></i>
                            <p><?php echo htmlentities($vehicule->FuelType);?></p>
                        </li>

                        <li>
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            <p><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</p>
                        </li>

                        <li>
                            <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                            <p>Climatisaté</p>
                        </li>
                        <li>
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <p><?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></p>
                        </li>
                    </ul>
                </div>
                <div class="listing_more_info">
                    <div class="listing_detail_wrap">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs gray-bg" role="tablist">
                            <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Description </a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- vehicle-overview -->
                            <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                                <p><?php echo htmlentities($vehicule->VehiclesOverview);?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!--Side-Bar-->
            <aside class="col-md-3">

                <div class="share_vehicle">
                    <p>Partager : <a href="https://www.facebook.com/Les.Transports.Citadins/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="https://twitter.com/ltcgabon"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></p>
                </div>
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Réservation Libreville</h5>
                    </div>
                    <form action="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'validateBooking', 'vehicule' => $vehicule->id]) ?>" method="post">
                        <div class="form-group">
                            <label>Lieu de départ</label>
                            <div class="input-group date">
                                <select class="form-control" id="lieu_depart" name="lieu_depart">
                                    <?= isset($data['lieu_depart'])  && $data['lieu_depart'] != "" ? "<option>".$data['lieu_depart']."</option>" : '' ?>
                                    <option value="Hôtel Le Méridien RE-NDAMA">Hôtel Le Méridien RE-NDAMA</option>
                                    <option value="Hôtel Le Cristal">Hôtel Le Cristal</option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#addplace_depart" data-toggle="modal" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lieu d'arrivée</label>
                            <div class="input-group date">
                                <select class="form-control" id="lieu_arriver" name="lieu_arriver">
                                    <?= isset($data['lieu_arriver']) && $data['lieu_arriver'] != "" ? "<option>".$data['lieu_arriver']."</option>" : '' ?>
                                    <option value="Hôtel Le Méridien RE-NDAMA">Hôtel Le Méridien RE-NDAMA</option>
                                    <option value="Hôtel Le Cristal">Hôtel Le Cristal</option>
                                </select>
                                <span class="input-group-addon">
                                    <a href="#addplace_arriver" data-toggle="modal" data-dismiss="modal"><span class="glyphicon glyphicon-plus"></span></a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de départ</label>
                            <input type="text" class="mt10px input form-control" id="J-demo-03" name="date_depart" placeholder="Date de Départ" <?= isset($data) && !empty($data) ? "value='".$data['date_depart']."'" : '' ?> required>
                            <script type="text/javascript">
                                $('#J-demo-03').dateTimePicker({
                                    mode: 'dateTime',
                                    limitMin: '<?php $date = date('Y-m-d H:m:s'); echo $date; ?>',
                                    limitMax: '2099-12-31 23:59:59'
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label>Heure d'arrivée</label>
                            <input type="text" class="mt10px input form-control" id="J-demo-04" name="date_arriver" placeholder="Date de Retour" <?= isset($data) && !empty($data) ? "value='".$data['date_arriver']."'" : '' ?> required>
                            <script type="text/javascript">
                                $('#J-demo-04').dateTimePicker({
                                    mode: 'dateTime',
                                    limitMin: '<?php $date = date('Y-m-d H:m:s'); echo $date; ?>',
                                    limitMax: '2099-12-31 23:59:59'
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn"  name="submit" value="Reserver">
                        </div>
                    </form>
                    <hr>
                    <div class="widget_heading">
                        <h5><i class="fa fa-envelope" aria-hidden="true"></i>Découvrir le Gabon</h5>
                    </div>
                    <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'reservationSpeciale']) ?>">
                        <button class="btn btn-block">Réservation Spéciale</button>
                    </a>
                </div>
            </aside>
            <!--/Side-Bar-->
        </div>

        <div class="space-20"></div>
        <div class="divider"></div>

        <!--Similar-Cars-->
        <div class="similar_cars">
            <h3>Voitures Similaires</h3>
            <div class="row">
                <?php foreach($vehicules_related as $vehicule) { ?>
                <div class="col-md-4 grid_listing">
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-img"> <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?></a>
                        </div>
                        <div class="product-listing-content">
                            <h5><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></a></h5>
                            <p class="list-price"><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p><br>
                            <p class="list-price"><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>

                            <ul class="features_list">

                                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</li>
                                <li><i class="fa fa-tint" aria-hidden="true"></i><?php echo htmlentities($vehicule->FuelType);?></li>
                                <li><i class="fa fa-cogs" aria-hidden="true"></i> <?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
        <!--/Similar-Cars-->

    </div>
</section>
<!--/Listing-detail-->

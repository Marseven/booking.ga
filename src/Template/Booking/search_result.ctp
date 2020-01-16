<!--Page Header-->
<section class="page-header listing_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Recherche</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a></li>
                <li>Recherche</li>
            </ul>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Listing-->
<section class="listing-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <div class="result-sorting-wrapper">
                    <div class="sorting-count">
                        <p><span><?php if(isset($vehicules_search_A)){ echo $vehicules_search_A->count();}elseif(isset($vehicules_search_a)){echo $vehicules_search_a->count();} ?> Véhicule(s)</span></p>
                    </div>
                </div>

                <?php
                    if(isset($vehicules_search_A)){
                        if($vehicules_search_A->count() == 0) {
                            ?>
                            <div style="text-align: center; margin-bottom: 0px;" class="alert alert-block alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                Aucun Résultat
                            </div>
                            <?php
                        }
                        foreach($vehicules_search_A as $vehicule) {
                        if(isset($data)){
                            $data['vid'] = $vehicule->id;
                            if(\App\Model\Table\VehiculesTable::is_avaible($data)){
                                ?>
                                <div class="product-listing-m gray-bg">
                                    <div class="product-listing-img"><?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?></div>
                                    <div class="product-listing-content">
                                        <h5><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></a></h5>
                                        <p class="list-price"><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p>
                                        <p class="list-price"><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>
                                        <ul>
                                            <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</li>
                                            <li><i class="fa fa-tint" aria-hidden="true"></i><?php echo htmlentities($vehicule->FuelType);?></li>
                                            <li><i class="fa fa-cogs" aria-hidden="true"></i> <?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></li>
                                        </ul>
                                        <form action="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>" method="post">
                                            <input type="hidden" name="lieu_depart" value="<?= $data['lieu_depart'] ?>">
                                            <input type="hidden" name="lieu_arriver" value="<?= $data['lieu_arriver'] ?>">
                                            <input type="hidden" name="date_depart" value="<?= $data['date_depart'] ?>">
                                            <input type="hidden" name="date_arriver" value="<?= $data['date_arriver'] ?>">
                                            <button type="submit" class="btn">Selectioner <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div style="text-align: center; margin-bottom: 0px;" class="alert alert-block alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    Voiture indisponible pour cette période de temps
                                </div>
                                <?php
                            }
                        }else{?>
                            <div class="product-listing-m gray-bg">
                                <div class="product-listing-img"><?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?></div>
                                <div class="product-listing-content">
                                    <h5><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></a></h5>
                                    <p class="list-price"><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p>
                                    <p class="list-price"><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>
                                    <ul>
                                        <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</li>
                                        <li><i class="fa fa-tint" aria-hidden="true"></i><?php echo htmlentities($vehicule->FuelType);?></li>
                                        <li><i class="fa fa-cogs" aria-hidden="true"></i> <?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></li>
                                    </ul>
                                    <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>">
                                        <button  class="btn">Selectioner <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                                    </a>
                                </div>
                            </div>
                        <?php
                            }
                        }
                    }elseif(isset($vehicules_search_a)){
                        if($vehicules_search_a->count() == 0) {
                            ?>
                            <div style="text-align: center; margin-bottom: 0px;" class="alert alert-block alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                Aucun Résulat !
                            </div>
                            <?php
                        }
                        foreach($vehicules_search_a as $vehicule) {
                    ?>
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-img"><?= $this->Html->image("admin/img/vehicleimages/".$vehicule->Vimage1, ['fullBase' => true, 'alt'=>'image', 'class'=>'img-responsive']); ?></div>
                        <div class="product-listing-content">
                            <h5><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></a></h5>
                            <p class="list-price"><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p>
                            <p class="list-price"><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>
                            <ul>
                                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</li>
                                <li><i class="fa fa-tint" aria-hidden="true"></i><?php echo htmlentities($vehicule->FuelType);?></li>
                                <li><i class="fa fa-cogs" aria-hidden="true"></i> <?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></li>
                            </ul>
                            <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id]) ?>">
                                <button  class="btn">Selectioner <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                            </a>
                        </div>
                    </div>
                <?php
                }}
                ?>

                <!--div class="row">
                    <div class="container">
                        <ul class="pagination">
                            <?php echo $this->Paginator->prev('Précédent'); ?>
                            <?php echo $this->Paginator->numbers().' ' ; ?>
                            <?php echo $this->Paginator->next('Suivant'); ?>
                        </ul>
                    </div>
                </div-->

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

            <!--Side-Bar-->
            <aside class="col-md-3 col-md-pull-9">
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-filter" aria-hidden="true"></i> Trouver votre voiture </h5>
                    </div>
                    <div class="sidebar_filter">
                        <form action="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'searchResult']) ?>" method="post">
                            <div class="form-group select">
                                <select class="form-control" name="brand">
                                    <label class="form-label">Marque</label>
                                    <?php foreach($marques as $marque){?>
                                        <option value="<?php echo htmlentities($marque->id);?>"><?php echo htmlentities($marque->BrandName);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group select">
                                <select class="form-control" name="type">
                                    <label class="form-label">Type</label>
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

                            <div class="form-group">
                                <button type="submit" name="search" value="autre" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Rechercher </button>
                            </div>
                        </form>
                    </div>
                </div>
            </aside>
            <!--/Side-Bar-->
        </div>
    </div>
</section>
<!-- /Listing-->

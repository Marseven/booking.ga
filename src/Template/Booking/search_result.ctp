<!-- Start All Page Banner -->
<section class="all-page-banner item-one">
    <div class="d-table">
        <div class="d-tablecell">
            <div class="container">
                <div class="banner-text text-center">
                    <h1>Recherche</h1>
                    <ul>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'index']) ?>">Accueil</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li>Recherche</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End All Page Banner -->

<!-- Start Single Shop -->
<section class="shop-section left-shop-section ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="right-shop">
                    <div class="productsearchform perches-form-wrapper">
                        <form class="form-wrap" action="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'searchResult']) ?>" method="post">
                            <div class="form-group select">
                                <select class="form-control" name="classe">
                                    <option>VIP</option>
                                    <option>Classe 1</option>
                                    <option>Classe 2</option>
                                </select>
                            </div>
                            <div class="form-group select">
                                <select class="form-control" name="type">
                                    <option>Express</option>
                                    <option>Omnibus</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="search" value="autre" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Rechercher </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="left-shop">
                    <div class="row">
                        <?php if(isset($trains_search_A)){
                            if(!$trains_search_A->first()){ ?>
                                <div style="text-align: center;" class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    Aucun Résultats !
                                </div>
                            <?php } ?>
                            <?php
                            foreach($trains_search_A as $train)
                            {  
                                if(isset($data)){
                                    $data['tid'] = $vehicule->id;
                                    if(\App\Model\Table\TrainsTable::is_avaible($data)){
                                ?>
                                        <div class="col-sm-6 col-md-4 col-lg-4">
                                            <div class="single-shop">
                                                <div class="shop-image">
                                                    <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><?= $this->Html->image("admin/img/trainimages/".$vehicule->Timage1, ['fullBase' => true, 'alt'=>'image']); ?></a>

                                                    <div class="add-cart-hover">
                                                        <div class="d-table">
                                                            <div class="d-tablecell">
                                                                <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>" class="add-cart">Réserver</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-caption">
                                                    <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><h3><?php echo htmlentities($train->TrainTitle);?></h3></a>
                                                    <span>À partir de <?php echo htmlentities($train->PriceClasse2);?> FCFA</span>
                                                </div>
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
                                }else{ ?>
                                   <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="single-shop">
                                            <div class="shop-image">
                                                <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><?= $this->Html->image("admin/img/trainimages/".$vehicule->Timage1, ['fullBase' => true, 'alt'=>'image']); ?></a>

                                                <div class="add-cart-hover">
                                                    <div class="d-table">
                                                        <div class="d-tablecell">
                                                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>" class="add-cart">Réserver</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="image-caption">
                                                <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><h3><?php echo htmlentities($train->TrainTitle);?></h3></a>
                                                <span>À partir de <?php echo htmlentities($train->PriceClasse2);?> FCFA</span>
                                            </div>
                                        </div>
                                    </div> 
                             <?php } 
                            } 
                        }elseif(isset($trains_search_a)){
                            if($trains_search_a->count() == 0) { ?> 
                                <div style="text-align: center;" class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    Aucun Résultats !
                                </div>
                            <?php } ?>
                            <?php
                            foreach($trains_search_a as $train)
                            {  ?>
                                <div class="col-sm-6 col-md-4 col-lg-4">
                                    <div class="single-shop">
                                        <div class="shop-image">
                                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><?= $this->Html->image("admin/img/trainimages/".$vehicule->Timage1, ['fullBase' => true, 'alt'=>'image']); ?></a>

                                            <div class="add-cart-hover">
                                                <div class="d-table">
                                                    <div class="d-tablecell">
                                                        <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>" class="add-cart">Réserver</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="image-caption">
                                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><h3><?php echo htmlentities($train->TrainTitle);?></h3></a>
                                            <span>À partir de <?php echo htmlentities($train->PriceClasse2);?> FCFA</span>
                                        </div>
                                    </div>
                                </div>
                        <?php }} ?>

                    </div>
                    <nav class="pagination-wrap">
                        <ul class="pagination pagination-lg m-0">
                            <?php echo $this->Paginator->prev('Précédent'); ?>  
                            <?php echo $this->Paginator->numbers().' ' ; ?>
                            <?php echo $this->Paginator->next('Suivant'); ?>
                        </ul>
                    </nav>

                    <!-- Reletad Post -->
                    <section class="related-post related-post2">
                        <div class="container">
                            <div class="post-title text-center">
                                <h3>related post</h3>
                            </div>
                            <div class="related-post-slider owl-carousel owl-theme">
                                <?php foreach($trains_related as $train) { ?>
                                    <div class="single-shop">
                                        <div class="shop-image">
                                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><?= $this->Html->image("admin/img/vehicleimages/".$train->Vimage1, ['fullBase' => true, 'alt'=>'image']); ?></a>
            
                                            <div class="add-cart-hover">
                                                <div class="d-table">
                                                    <div class="d-tablecell">
                                                        <a href="#" class="add-cart">Réserver</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="image-caption">
                                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainItem', 'train' => $train->id]) ?>"><h3><?php echo htmlentities($train->Title);?></h3></a>
                                            <span>À partir de <?php echo htmlentities($train->PriceClasse2);?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                    <!-- End Reletad Post -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Single Shop -->
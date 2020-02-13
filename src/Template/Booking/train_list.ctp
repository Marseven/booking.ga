<!-- Start All Page Banner -->
<section class="all-page-banner item-one">
    <div class="d-table">
        <div class="d-tablecell">
            <div class="container">
                <div class="banner-text text-center">
                    <h1>Trains</h1>
                    <ul>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'index']) ?>">Accueil</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li>Trains</li>
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
                    <div class="productsearchform">
                        <h3 style="text-align:center;">Recherche</h3>
                        <form action="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'searchResult']) ?>">
                            <select class="form-control"  name="lieu_depart" style="width: 100%">
                                <option value="Owendo">Owendo</option>
                                <option value="Franceville">Franceville</option>
                            </select>
                            <br><br>
                            <select class="form-control"  name="lieu_arrive" style="width: 100%">
                                <option value="Owendo">Owendo</option>
                                <option value="Franceville">Franceville</option>
                            </select>
                            <br><br>
                            <select class="form-control" name="classe" style="width: 100%">
                                <option>VIP</option>
                                <option>Classe 1</option>
                                <option>Classe 2</option>
                            </select>
                            <br><br>     
                            <input type="date" class="form-control" name="date_depart" placeholder="Date de Départ">
                            <br>
                            <input type="submit" value="Rechercher" name="search" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="left-shop">
                    <div class="row">
                        <?php if(!$trains->first()){ ?>
                            <div style="text-align: center;" class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                Pas De trains pour le moment !
                            </div>
                        <?php } ?>
                        <?php
                        foreach($trains as $train)
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
                        <?php } ?>  
                    </div>
                    <nav class="pagination-wrap">
                        <ul class="pagination pagination-lg m-0">
                            <?php echo $this->Paginator->prev('Précédent'); ?>  
                            <?php echo $this->Paginator->numbers().' ' ; ?>
                            <?php echo $this->Paginator->next('Suivant'); ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Single Shop -->
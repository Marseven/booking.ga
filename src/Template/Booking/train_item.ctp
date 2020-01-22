<!-- Start All Page Banner -->
<section class="all-page-banner item-one">
            <div class="d-table">
                <div class="d-tablecell">
                    <div class="container">
                        <div class="banner-text text-center">
                            <h1><?php echo htmlentities($train->Title);?></h1>
                            <ul>
                                <li>
                                    <a href="index-2.html">Accueil</a>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </li>
                                <li><?php echo htmlentities($train->Title);?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End All Page Banner -->

        <!-- Start Single Shop -->
        <section class="shop-section ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="left-shop">
                            <!-- Shop Cart Details Start -->
                            <div class="cart-details pb-70">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="shop-single-slider">
                                            <div class="slider-for border-for">
                                                <div><?= $this->Html->image("admin/img/trainimages/".$train->Timage1, ['fullBase' => true, 'alt'=>'image']); ?></div>
                                                <div><?= $this->Html->image("admin/img/trainimages/".$train->Timage2, ['fullBase' => true, 'alt'=>'image']); ?></div>
                                            </div>
                                            <div class="slider-nav border-nav">
                                                <div><?= $this->Html->image("admin/img/trainimages/".$train->Timage1, ['fullBase' => true, 'alt'=>'image']); ?></div>
                                                <div><?= $this->Html->image("admin/img/trainimages/".$train->Timage2, ['fullBase' => true, 'alt'=>'image']); ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-8">
                                        <div class="product-details">
                                            <h3><?php echo htmlentities($train->Title);?></h3>
                                            <div class="price">
                                                <span class="current">À partir de <?php echo htmlentities($train->PriceClasse2);?> FCFA</span>
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. 
                                            </p>
                
                                            <div class="product-option">
                                                <form class="form">
                                                    <div class="product-row">
                                                        <div>
                                                            <input id="product-count" type="number" value="1" name="product-count">
                                                        </div>
                                                        <div>
                                                            <button type="submit" class="theme-btn">Réserver</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> 
                                            <h6><span>Type : </span><?php echo htmlentities($train->Type);?></h6>
                                        </div> <!-- Products Details -->
                                    </div> 
                                </div> <!-- end row -->
                            </div>
                            <!-- End Shop Cart Details -->

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
                    
                    <div class="col-lg-4">
                        <div class="right-shop">
                            <div class="productsearchform">
                                <form action="#">
                                    <input type="text" placeholder="Search Here">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="productsearchform">
                                <form action="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'validateBooking', 'train' => $train->id]) ?>" method="post">
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
                            </div>
                            <div class="top-rated-products">
                                <div class="products-box">
                                    <div class="pro-title">
                                        <h3>top rated products</h3>
                                    </div>
                                    <div class="product-wrapper">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <div class="single-product">
                                                    <a href="#"><h3>Donec ali berto</h3></a>
                                                    <ul class="star-list">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <div class="price">
                                                        <span>$8.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="single-product single-product-image">
                                                    <img src="assets/img/shop/related-post/1.png" alt="Image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Single Shop -->
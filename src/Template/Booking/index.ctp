<!-- Main Slider Start -->
<section class="main-slider owl-carousel owl-theme">
    <div class="single-slider-item item-bg-one">
        <div class="d-table">
            <div class="d-tablecell">
                <div class="container">
                    <div class="slider-text">
                        <div class="d-table">
                            <div class="d-tablecell">
                                <h1>Désormais réservez en Ligne</h1>
                                <p>SETRAG</p>
                            </div>
                        </div>
                        <div class="slider-button">
                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainList']) ?>" class="custom-btn2">Réserver Maintenant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-slider-item item-bg-two">
        <div class="d-table">
            <div class="d-tablecell">
                <div class="container">
                    <div class="slider-text">
                        <div class="d-table">
                            <div class="d-tablecell">
                                <h1>Gagnez du temps !</h1>
                                <p>SETRAG</p>
                            </div>
                        </div>
                        <div class="slider-button">
                            <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainList']) ?>" class="custom-btn2">Réserver Maintenant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Main Slider -->

<!-- Perches Section -->
<section class="perches-section">
    <div class="container">
        <div class="perches-form-wrapper">
            <?= $this->Form->create($search, ['url' => ['controller' => 'Transports', 'action' => 'searchResult']]); ?>
                <div class="form-wrap">
                    <div class="single-select">
                        <label class="form-label">Lieu de départ : </label>
                        <select class="form-control" id="lieu_depart" name="lieu_depart">
                            <option value="Owendo">Owendo</option>
                            <option value="Franceville">Franceville</option>
                        </select>
                    </div>

                    <div class="single-select">
                        <label class="form-label">Lieu d'arrivé : </label>
                        <select class="form-control" id="lieu_arrive" name="lieu_arrive">
                            <option value="Owendo">Owendo</option>
                            <option value="Franceville">Franceville</option>
                        </select>
                    </div>

                    <div class="single-select">
                        <label class="form-label">Classe : </label>
                        <select class="form-control" name="classe">
                            <option>VIP</option>
                            <option>Classe 1</option>
                            <option>Classe 2</option>
                        </select>
                    </div>

                    <div class="single-select" style="margin-right: 5%">
                        <label class="form-label">Départ le : </label>
                        <div class="select">
                            <input type="date" class="form-control" id="J-demo-04" name="date_depart" placeholder="Date de Départ">
                        </div>
                    </div>

                    <div class="submit-button">
                        <button type="submit" value="accueil" name="search" class="search-button">Rechercher</button>
                    </div>
                </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</section>
<!-- End Perches Section -->

<!-- Start About Section -->
<br><br>
<section class="about-section pb-100">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="ab-left">
                    <div class="section-title">
                        <h2>À Propos de SETRAG</h2>
                        <p>We are Trusted Name in Car Sales & Services</p>
                        <span>company</span>
                    </div>
                    <div class="single-about">
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus. consectetur adipiscing elit, sed do tempor incididunt ut.</p>
                        </div>
                        <div class="ab-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-4">
                                    <ul>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            best prices
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            drive service
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            car drop Facility
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i> 
                                            Finance Facility
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <ul>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            National Coverage
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            no booking fee
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            Frequent Inspections
                                        </li>
                                        <li>
                                            <i class="flaticon-check-mark"></i>
                                            Well Maintained Vehicles 
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="custom-btn2">read more</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-about">
                    <div class="image-two">
                        <img src="/booking.ga-git/img/about/2.jpg" alt="Image">
                    </div>
                    <div class="image-one">
                        <img src="/booking.ga-git/img/about/1.jpg" alt="Image">
                    </div>
                    <div class="image-three">
                        <img src="/booking.ga-git/img/about/border.png" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Section -->

<!-- Start Recently Added -->
<section class="recent-add-section pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <h2>Trains disponibles</h2>
            <p>Setrag</p>
            <span>Réserver</span>
        </div>
        <div class="row">
            <?php if(!$trains->first()){ ?>
                <div style="text-align: center;" class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    Pas De trains pour le moment !
                </div>
            <?php } ?>
            <?php foreach($trains as $k => $train){ ?>
                <div class="col-md-6 col-lg-3">
                    <div class="single-add-box">   
                        <div class="image">
                            <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'trainItem', 'train' => $train->id]) ?>">
                                <?= $this->Html->image("admin/img/trainimages/".$train->Timage1, ['fullBase' => true, 'alt'=>'image']); ?>
                            </a>
                        </div> 
                        <div class="image-caption-wrapper">
                            <div class="add-box-content">
                                <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'trainItem', 'train' => $train->id]) ?>"><h3><?php echo htmlentities($train->TrainsTitle);?></h3></a>
                                <div class="info-list">
                                    <ul>
                                        <li><i class="flaticon-car"></i><?php echo htmlentities($train->NombrePlace);?></li>
                                        <li><i class="flaticon-shifter"></i><?php echo htmlentities($train->Type);?></li>
                                        <li><i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i><?php echo htmlentities($train->Depart);?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="add-box-bottom">
                                <a href="#"><h5>À partir de <?php echo htmlentities(\App\Controller\AppController::change_number_format($train->PriceClasse2));?> FCFA</h5></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End Recently Added -->

<!-- Start Counter Section -->
<section class="counter-section ptb-100">
    <div class="container">
        <div class="counter-title text-center">
            <span>Une Compagnie expérimenté </span>
            <h2>Une expérience unique ?</h2>
            <p>MotorLand is nisi aliquip exa con velit esse cillum dolore fugiatal sint 
            occaecat excepteur ipsum dolor sit amet consectetur.</p>
        </div>
        <div class="row">   
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="single-counter media">
                    <i class="flaticon-support"></i>
                    <div class="average">
                        <h2>
                            <span class="counter">10,0000</span> 
                            +
                        </h2>
                        <h6>clients heureux</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="single-counter media">
                    <i class="flaticon-delivery-truck"></i>
                    <div class="average">
                        <h2>
                            <span class="counter">60 </span> 
                            +
                        </h2>
                        <h6>trajets par mois</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 offset-sm-3 offset-lg-0 col-lg-4">
                <div class="single-counter media">
                    <i class="flaticon-technical-support"></i>
                    <div class="average">
                        <h2>
                            <span class="counter">52,870</span> 
                            +
                        </h2>
                        <h6>wagons en fonction</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Counter Section -->

<!-- Start Testimonial Section -->
<section class="testimonial-section ptb-100">
    <div class="container">
        <div class="section-title text-center">
            <h2>testimonial</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
            <span>testimonial</span>
        </div>
        <?php if(!$temoignages->first()){ ?>
            <div style="text-align: center;" class="col-lg-12 alert alert-info">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>
                Aucun témoignage pour le moment !
            </div>
        <?php } ?>
        <?php foreach($temoignages as $k => $temoignage){ ?>
            <div class="testimonial-slider owl-carousel owl-theme">
                <div class="testimonial-single-item text-center">
                    <i class="flaticon-quote"></i>
                    <p>
                        <?php echo htmlentities($temoignage->Testimonial);?> 
                    </p>
                    <div class="profile">
                        <?= $this->Html->image("/images/cat-profile.png", ['fullBase' => true, 'alt'=>'image']); ?>
                        <h3><?php echo htmlentities($temoignage->user->FirstName);?> <?php echo htmlentities($temoignage->user->LastName);?></h3>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- End Testimonial Section -->

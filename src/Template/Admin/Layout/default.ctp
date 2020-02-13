<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license inFormation, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- All CSS -->
        <?= $this->Html->css('bootstrap.min.css') ?>
        <!-- Owl-Carosel CSS -->
        <?= $this->Html->css('owl.carousel.min.css') ?>
        <!-- Theme Default CSS -->
        <?= $this->Html->css('owl.theme.default.min.css') ?>
        <!-- Font Awesome CSS -->
        <?= $this->Html->css('font-awesome.min.css') ?>
        <!-- Magnific Popup CSS -->
        <?= $this->Html->css('magnific-popup.css') ?>
        <!-- Flat Icon CSS -->
        <?= $this->Html->css('flaticon.css') ?>
        <!--  Nice Select CSS -->
        <?= $this->Html->css('nice-select.css') ?>
        <!--  Animate CSS -->
        <?= $this->Html->css('animate.css') ?>
        <!--  Slick CSS -->
        <?= $this->Html->css('slick.css') ?>
        <!-- Style CSS -->
        <?= $this->Html->css('style.css') ?>
        <!-- Responsive CSS -->
        <?= $this->Html->css('responsive.css') ?>

        <!-- Inject CSS -->
        <?= $this->fetch('css') ?>

        <!-- Title -->
        <title>Setrag - Réserver vos Billets en ligne</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        
    </head>

    <body>
        <!-- Start Preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div>
        <!-- End Preloader -->
        
        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
                <a href="index-2.html" class="logo">
                    <img src="assets/img/logo.png" alt="Image">
                </a> 
            </div>
            <!-- Menu For Desktop Device -->
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <div class="logo">
                            <a class="navbar-brand" href="index-2.html">
                                <img src="assets/img/logo.png" alt="Logo">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'index']) ?>" class="nav-link">Accueil</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'trainList']) ?>" class="nav-link">Trains</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Espace Client</a>
                                    <ul class="dropdown-menu">
                                        <?php if(isset($user)){?>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'demandeSpeciale']) ?>">Demande Spéciale</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservationList']) ?>">Mes Réservations</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'add']) ?>">Témoigner</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'index']) ?>">Mes Témoignageages</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Profil</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword']) ?>">Changer le Mot de passe</a></li>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
                                        <?php } else { ?>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" >Connexion</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav"> 
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-add-to-cart"></i>
                                        <span class="badge"><?= \App\Controller\AppController::change_number_Format($_SESSION['panier']['prix']) ?> FCFA</span>
                                    </a>
                                    <ul id="panier" class="dropdown-menu">
                                        <?php if(isset($_SESSION['panier']['train']) && !empty($_SESSION['panier']['train'])){?>
                                        <li><a href="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'validateBooking', 'train' => $_SESSION['panier']['train']['id']]) ?>"><button type="button" style="background-color: #98be0e; color: white;" class="btn btn-sm btn-danger"><i class="fa fa-shopping-cart"></i> Voir le panier</button></a></li>
                                        <li><a href="<?= $this->Url->build(['controller' => 'Booking', 'action' => 'index', 'reset' => 'true']) ?>"><button type="button" style="background-color: red; color: white;" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Annuler</button></a></li>
                                        <?php }else{ ?>
                                            <li>Panier Vide</li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

        <!-- Start Subscribe Section -->
        <section class="subscribe-section">
            <div class="container">
                <div class="subscribe-content">
                    <p>Get the latest news from Kiaro</p>
                    <h2>Subscribe To Our Newsletter</h2>
                    <form>
                        <input type="email" class="form-control" id="newsletteremail" placeholder="email address">
                        <button type="submit" class="btn">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Subscribe Section -->

        <!-- Start Top Footer -->
        <footer class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="single-widget">
                            <div class="logo-image">
                                <a href="index-2.html">
                                    <img src="assets/img/logo.png" alt="Logo">
                                </a>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the printing 
                            and typesetting industry. Lorem Ipsum has been 
                            the industry's standard dummy text ever since 
                            the 1500s, when an unknown printer took a 
                            galley of type and scrambled it to make a 
                            type specimen. </p>
                            <div class="social-icon">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-paypal-logo"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <div class="single-widget">
                            <h3>quick links</h3>
                            <div class="page-list">
                                <ul>
                                    <li>
                                        <a href="car-listing.html">
                                            car listing
                                        </a>
                                    </li>
                                    <li>
                                         <a href="product-details.html">
                                             product details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="contact.html">
                                            contact us
                                        </a>
                                    </li>
                                    <li>
                                        <a href="blog-details.html">
                                            blog details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="team.html">
                                            our team
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop-details.html">
                                            shop details
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widget">
                            <h3>INSTAGRAM</h3>
                            <div class="img-list">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/1.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/2.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/3.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/4.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/5.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/6.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/7.png" alt="Image"></a>
                                        </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/8.png" alt="Image">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="assets/img/footer/9.png" alt="Image">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="single-widget">
                            <h3>address</h3>
                            <div class="information">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                                            office 305, street 05 Newyork
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-smartphone-call"></i>
                                            +82549314
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-whatsapp"></i>
                                            +58462329
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-close-envelope"></i>
                                            info@kiaro.com
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="flaticon-close-envelope"></i>
                                            support@kiaro.com
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Top Footer -->

        <!-- Start Bottom Footer -->
        <footer class="footer-bottom">
            <div class="container">
                <p class="envytheme-link">
                    Copyright 2020 © Setrag. Tous droits reservés.
                </p>
            </div>
        </footer>
        <!-- End Bottom Footer -->


        <!-- All Js -->
        <!-- Jquery Min Js -->
        <?= $this->Html->script('jquery-min') ?>
        <!-- Popper Min Js -->
        <?= $this->Html->script('popper.min') ?>
        <!-- Bootstrap Min Js -->
        <?= $this->Html->script('bootstrap.min') ?>
        <!-- Owl.Carousel Min Js -->
        <?= $this->Html->script('owl.carousel.min') ?>
        <!-- Nice Select Js -->
        <?= $this->Html->script('jquery.nice-select') ?>
        <!-- Meanmenu Min Js -->
        <?= $this->Html->script('jquery.meanmenu') ?>
        <!-- Popup Magnific -->
        <?= $this->Html->script('jquery.magnific-popup.min') ?>
        <!-- slick Js -->
        <?= $this->Html->script('slick.min') ?>
        <!-- WOW Js -->
        <?= $this->Html->script('wow.min') ?>
        <!-- Counter Js -->
        <?= $this->Html->script('jquery.counterup.min') ?>
        <!-- Waypoints Js -->
        <?= $this->Html->script('waypoints.min') ?>
        <!-- Active Js -->
        <?= $this->Html->script('active') ?>

        <!-- Inject JS -->
        <?= $this->fetch('script') ?>
    </body>
</html>
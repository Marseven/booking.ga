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
        
        
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

        
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
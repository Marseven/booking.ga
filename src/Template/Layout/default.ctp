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
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="Voiture, Bus, Toyota, Yaris, Prado, Réservation">
    <meta name="description" content="Site de réservation de véhicules en ligne.">
    <?= $this->fetch('meta') ?>

    <title>
        Les Transports Citadins
    </title>

    <link rel="shortcut icon" href="/img/icone-ltc.png">

    <!--Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('owl.carousel.css') ?>
    <?= $this->Html->css('owl.transitions.css') ?>
    <?= $this->Html->css('slick.css') ?>
    <?= $this->Html->css('bootstrap-slider.min.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->fetch('css') ?>

    <?= $this->Html->script('https://code.jquery.com/jquery-1.12.4.min.js') ?>
    <?= $this->Html->script('https://www.jqueryscript.net/demo/Cross-browser-Date-Time-Selector-For-jQuery-dateTimePicker/date-time-picker.min.js') ?>



    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

<!--Header-->

<header>
    <div class="default-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <div class="logo"> <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>"><?= $this->Html->image("logo-ltc.png", ['fullBase' => true, 'class' => 'logo', 'alt'=>'image']); ?></a> </div>
                </div>
                <div class="col-sm-9 col-md-10">
                    <div class="header_info">
                        <div class="header_widgets">
                            <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                            <p class="uppercase_text">Support : </p>
                            <a style="font-size: 13px;" href="mailto:w.asseko@transports-citadins.com">w.asseko@transports-citadins.com</a> </div>
                        <div class="header_widgets">
                            <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                            <p class="uppercase_text">Service En Ligne: </p>
                            <a href="#">(+241) 01 79 32 54 / 04 13 83 74</a> </div>
                        <div class="social-follow" style="margin: 20px;">
                            <ul>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 15px; font-weight: 900; text-transForm: uppercase;">
                                        <i class="fa fa-shopping-cart"></i> Panier
                                        <span class="badge"><?= \App\Controller\AppController::change_number_Format($_SESSION['panier']['prix']) ?> FCFA</span>
                                    </a>
                                    <ul id="panier" class="dropdown-menu">
                                        <?php if(isset($_SESSION['panier']['voiture']) && !empty($_SESSION['panier']['voiture'])){?>
                                        <li><a href="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'validateBooking', 'vehicule' => $_SESSION['panier']['voiture']['id']]) ?>"><button type="button" style="background-color: #98be0e; color: white;" class="btn btn-sm btn-danger"><i class="fa fa-shopping-cart"></i> Voir le panier</button></a></li>
                                        <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index', 'reset' => 'true']) ?>"><button type="button" style="background-color: red; color: white;" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Annuler</button></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navigation_bar" class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="header_wrap">
                <div class="user_login">
                    <ul>
                        <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <?php if(isset($user)){echo $user['FirstName'];} ?>
                                <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                <?php if(isset($user)){?>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Profil</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword']) ?>">Changer le Mot de passe</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservationList']) ?>">Mes Réservations</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'add']) ?>">Témoigner</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Temoignages', 'action' => 'index']) ?>">Mes Témoignageages</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
                                <?php } else { ?>
                                    <li><a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Espace Client</a></li>
                                <?php } ?>
                            </ul>
                    </ul>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav">
                    <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">Accueil</a>
                    <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeList']) ?>">Véhicules</a>
                    <li><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'demandeSpeciale']) ?>">Demande Spéciale</a>
                    <?php if(!isset($user)){?>
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Espace Client</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navigation end -->

</header>
<!-- /Header -->

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<!--Footer -->
<footer>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6 text-right">
                    <div class="footer_widget">
                        <p>Suivez-Nous:</p>
                        <ul>
                            <li><a href="https://www.facebook.com/Les.Transports.Citadins/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/ltcgabon"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-md-pull-6">
                    <p class="copy-right">Copyright &copy; 2018 Les Transports Citadins. Tous Droits Reservés</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top-->

<!--Login-form -->
<div class="modal fade" id="loginform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Connexion</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="login_wrap">
                        <div class="col-md-12 col-sm-6">
                            <?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'login']]); ?>
                                <div class="form-group">
                                    <?= $this->Form->input('Email', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Email',
                                        'type' => 'text',
                                        'label' => 'Email',
                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Password', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Mot de passe',
                                        'type' => 'password',
                                        'label' => 'Mot de Passe',
                                    )); ?>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="remember">

                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Connexion', array(
                                        'class' => 'btn btn-success',
                                        'id'    => 'connexion',
                                        'type'  => 'submit',
                                        'label' => ''
                                    )); ?>
                                </div>
                            <?= $this->Form->end(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <p>Pas de compte? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Enregistrement</a></p>
                <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Mot de Passe Oublié ?</a></p>
            </div>
        </div>
    </div>
</div>
<!--/Login-form -->

<!--Register-form -->
<div class="modal fade" id="signupform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Enregistrement</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="signup_wrap">
                        <div class="col-md-12 col-sm-6">
                            <?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'signup']]); ?>
                                <div class="form-group">
                                    <?= $this->Form->input('FirstName', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Nom*',
                                        'label' => 'Nom',
                                        'required',
                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('LastName', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Prenom',
                                        'label' => 'Prénom',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('ContactNo', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Téléphone*',
                                        'label' => 'Téléphone',
                                        'maxlength' => '10',
                                        'required'
                                    )); ?>
                                </div>
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
                                <div class="form-group">
                                    <label class="form-label">Date de Naissance </label>
                                    <div class="select">
                                        <input type="date" class="form-control white_bg" name="BornDate" placeholder="Date de naissance*" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Address', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Adresse',
                                        'label' => 'Adresse',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('City', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Ville',
                                        'label' => 'Ville',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('ZipCode', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Code Postal',
                                        'label' => 'Code Postal',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Province', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Province',
                                        'label' => 'Province',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Country', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Pays',
                                        'label' => 'Pays',

                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Password', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Mot de Passe*',
                                        'type' => 'password',
                                        'label' => 'Mot de Passe',
                                        'required',
                                    )); ?>

                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Password_verify', array(
                                        'class' => 'form-control',
                                        'type' => 'password',
                                        'placeholder' => 'Confirmer Mot de Passe*',
                                        'label' => 'Confirmer Mot de Passe',
                                        'required',
                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('S\'enregister', array(
                                        'class' => 'btn btn-block',
                                        'type'  => 'submit',
                                        'label' => ''
                                    )); ?>
                                </div>
                            <?= $this->Form->end(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <p>Vous avez déjà un compte? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Connexion</a></p>
            </div>
        </div>
    </div>
</div>

<!--/Register-Form -->

<!--Forgot-password-Form -->
<div class="modal fade" id="forgotpassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Mot de Passe Oublié</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="forgotpassword_wrap">
                        <div class="col-md-12">
                        <?= $this->Form->create('User', ['url' => ['controller' => 'Users', 'action' => 'remember']]); ?>
                                <div class="form-group">
                                    <?= $this->Form->input('Email', array(
                                        'class' => 'form-control',
                                        'placeholder' => 'Email',
                                        'type' => 'email',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->input('Envoyer', array(
                                        'class' => 'btn btn-sm btn-block',
                                        'id'    => 'envoyer',
                                        'type'  => 'submit',
                                    )); ?>
                                </div>
                            <?= $this->Form->end(); ?>
                            <div class="text-center">
                                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Connexion</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Forgot-password-Form -->

<!--add-Form -->
<div class="modal fade" id="addplace_arriver">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Ajouter un Lieu</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="forgotpassword_wrap">
                        <div class="col-md-12">
                            <form>
                                <div class="form-group">
                                   <input class="form-control" id="place1" placeholder="Le Lieu">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="button" onclick="myFunction1()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Ajouter</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/add-Form -->
<script>
    function myFunction1() {
        var x = document.getElementById("lieu_arriver");
        var option = document.createElement("option");
        option.text =  document.getElementById("place1").value;
        option.selected = 'selected';
        x.add(option, x[0]);
    }
</script>
<!--add-Form -->
<div class="modal fade" id="addplace_depart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Ajouter un Lieu</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="forgotpassword_wrap">
                        <div class="col-md-12">
                            <form>
                                <div class="form-group">
                                    <input class="form-control" id="place2" placeholder="Le Lieu">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="button" onclick="myFunction2()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Ajouter</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/add-Form -->
<script>
    function myFunction2() {
        var x = document.getElementById("lieu_depart");
        var option = document.createElement("option");
        option.text =  document.getElementById("place2").value;
        option.selected = 'selected';
        x.add(option, x[0]);
    }
</script>

<!-- Scripts -->
<?= $this->Html->script('http://code.jquery.com/jquery.js') ?>
<?= $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') ?>
<?= $this->Html->script('interface') ?>
<!--bootstrap-slider-JS-->
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js') ?>
<!--Slider-JS-->
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js') ?>
<?= $this->Html->script('owl.carousel.min') ?>
<!--DateTime-Picker-->
<?= $this->fetch('script') ?>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>
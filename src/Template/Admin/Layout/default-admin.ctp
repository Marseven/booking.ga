<!DOCTYPE html>
<html lang="fr">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<!-- Meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Site de réservation en ligne">
<meta name="keywords" content="trains, reservation, en ligne">
<!-- /meta tags -->
<title> Setrag </title>

<!-- Site favicon -->
<link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
<!-- /site favicon -->

<!-- Font Icon Styles -->
<?= $this->Html->css('../admin/fonts/noir-pro/styles.css') ?>
<?= $this->Html->css('../admin/plugins/flag-icon-css/css/flag-icon.min.css') ?>
<?= $this->Html->css('../admin/vendor/gaxon-icon/styles.css') ?>
<!-- /font icon Styles -->

<!-- Perfect Scrollbar stylesheet -->
<?= $this->Html->css('../admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>
<!-- /perfect scrollbar stylesheet -->

<?= $this->Html->css('../admin/plugins/owl.carousel/css/owl.carousel.min.css') ?>
<?= $this->Html->css('../admin/plugins/chartist/css/chartist.min.css') ?>

<?= $this->Html->css('../admin/css/back-office/theme.min.css') ?>

<?= $this->fetch('css') ?>

<script>
    var rtlEnable = '';
        var $mediaUrl = '../index.html';
        var $baseUrl = '../index.html';
    var current_path = window.location.href.split('../index.html').pop();
    if (current_path == '') {
        current_path = 'index-2.html';
    }
</script>

<?= $this->Html->script('../admin/plugins/jquery/js/jquery.min.js') ?>
<?= $this->Html->script('../admin/plugins/moment/js/moment.min.js') ?>
<?= $this->Html->script('../admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>
<!-- Perfect Scrollbar jQuery -->
<?= $this->Html->script('../admin/plugins/perfect-scrollbar/js/perfect-scrollbar.min.js') ?>
<!-- /perfect scrollbar jQuery -->

</head>
<body class="dt-layout--back-office dt-sidebar--fixed">
    <!-- Loader -->
<div class="dt-loader-container">
  <div class="dt-loader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
    </svg>
  </div>
</div>
<!-- /loader -->
    <!-- Root -->
    <div class="dt-root">
        <div class="dt-root__inner">

            <!-- Site Main -->
            <main class="dt-main">
                <!-- Sidebar -->
<aside id="main-sidebar" class="dt-sidebar">
    <!-- Sidebar Header -->
    <div class="dt-sidebar__header">
        <!-- Brand -->
        <div class="dt-brand">

            <!-- Brand logo -->
            <span class="dt-brand__logo">
                <a class="dt-brand__logo-link" href="index-2.html">
                    <img class="dt-brand__logo-img" src="../assets/images/logo-white.png" alt="Drift">
                    <img class="dt-brand__logo-symbol" src="../assets/images/logo-symbol.png" alt="Drift">
                </a>
            </span>
            <!-- /brand logo -->

        </div>
        <!-- /brand -->
    </div>
    <!-- /sidebar header -->

    <!-- Sidebar Container -->
    <div class="dt-sidebar__container">

        <!-- Sidebar Notification -->
        <div class="dt-sidebar__notification">
            <!-- Dropdown -->
            <div class="dropdown mb-6">

                <!-- Dropdown Link -->
                <a href="#" class="dropdown-toggle dt-avatar-wrapper text-white"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="dt-avatar" src="../assets/images/user-avatar/domnic-harris.jpg" alt="Administrateur">
                    <span class="dt-avatar-info">
                        <span class="dt-avatar-name">Admin</span>
                    </span> </a>
                <!-- /dropdown link -->

                <!-- Dropdown Option -->
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dt-avatar-wrapper flex-nowrap p-6 mt-n2 bg-gradient-purple text-white rounded-top">
                        <img class="dt-avatar" src="../assets/images/user-avatar/domnic-harris.jpg" alt="Domnic Harris">
                        <span class="dt-avatar-info">
                            <span class="dt-avatar-name">Admin</span>
                            <span class="f-12">Administrateur</span>
                        </span>
                    </div>
                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profil']) ?>"> <i class="icon icon-user icon-fw mr-2 mr-sm-1"></i>Profil
                    <a class="dropdown-item" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>"> <i class="icon icon-editors icon-fw mr-2 mr-sm-1"></i>Déconnexion
                    </a>
                </div>
                <!-- /dropdown option -->

            </div>
            <!-- /dropdown -->
        </div>
        <!-- /sidebar notification -->

        <!-- Sidebar Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">Menu</span>
            </li>
            <!-- /menu header -->

            <!-- Menu Item -->
            <li class="dt-side-nav__item">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Layouts">
                    <i class="icon icon-layout icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Tableau de Bord</span>
                </a>
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow">
                    <i class="icon icon-dashboard icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Réservation</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservations']) ?>" class="dt-side-nav__link">
                            <i class="icon icon-listing-dbrd icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>

                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'list_member']) ?>" class="dt-side-nav__link">
                            <i class="icon icon-company icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Clients</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Trains</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Trains', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Trains', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Catégories</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Villes</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Villes', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Villes', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Tarifs</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Tarifs', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Tarifs', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Semaines</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Semaines', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Semaines', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <li class="dt-side-nav__item">
                <a href="javascript:void(0)" class="dt-side-nav__link dt-side-nav__arrow" title="Widgets">
                    <i class="icon icon-widgets icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Classes</span>
                </a>

                <!-- Sub-menu -->
                <ul class="dt-side-nav__sub-menu">
                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Classes', 'action' => 'add']) ?>" class="dt-side-nav__link" title="Classic">
                            <i class="icon icon-components icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Ajouter</span>
                        </a>
                    </li>


                    <li class="dt-side-nav__item">
                        <a href="<?= $this->Url->build(['controller' => 'Classes', 'action' => 'index']) ?>" class="dt-side-nav__link" title="Modern">
                            <i class="icon icon-datatable icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">Liste</span>
                        </a>
                    </li>
                </ul>
                <!-- /sub-menu -->
            </li>
            <!-- /menu item -->
        </ul>
        <!-- /sidebar navigation -->

    </div>
    <!-- /sidebar container -->
</aside>
<!-- /sidebar -->                
<!-- Site Content Wrapper -->
<div class="dt-content-wrapper">

<!-- Site Content -->
<div class="dt-content">
                            
    
<?= $this->fetch('content') ?>

<!-- Footer -->
<footer class="dt-footer">
  Copyright Setrag © 2020
</footer>
<!-- /footer -->
</div>
<!-- /site content wrapper -->

        
<?= $this->Html->script('../admin/plugins/masonry-layout/js/masonry.pkgd.min.js') ?>
<?= $this->Html->script('../admin/plugins/sweetalert2/js/sweetalert2.js') ?>
<?= $this->Html->script('../admin/js/back-office/functions.js') ?>
<?= $this->Html->script('../admin/js/back-office/customizer.js') ?>

<?= $this->Html->script('../admin/js/back-office/script.js') ?>
<?= $this->Html->script('../admin/plugins/chartist/js/chartist.min.js') ?>
<?= $this->Html->script('../admin/plugins/owl.carousel/js/owl.carousel.min.js') ?>
<?= $this->Html->script('../admin/js/global/charts/dashboard-listing.js') ?>

<?= $this->fetch('script') ?>

</body>

</html>

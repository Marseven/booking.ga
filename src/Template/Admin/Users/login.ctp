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
<body>

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
            <div class="dt-login--container">

    <!-- Login Content -->
    <div class="dt-login__content-wrapper">

        <!-- Login Background Section -->
        <div class="dt-login__bg-section">

            <div class="dt-login__bg-content">
                <!-- Login Title -->
                <h1 class="dt-login__title">Connexion</h1>
                <!-- /login title -->

                <p class="f-16">Gérer les réservations des Billets</p>
            </div>


            <!-- Brand logo -->
            <div class="dt-login__logo">
                <a class="dt-brand__logo-link" href="index-2.html">
                    <img class="dt-brand__logo-img" src="../assets/images/logo-white.png" alt="Drift">
                </a>
            </div>
            <!-- /brand logo -->

        </div>
        <!-- /login background section -->

        <!-- Login Content Section -->
        <div class="dt-login__content">
            <?= $this->Flash->render() ?>
            <!-- Login Content Inner -->
            <div class="dt-login__content-inner">

                <!-- Form -->
                <?= $this->Form->create('User', ['url' => ['Controller' => 'Users','action' => 'login']]); ?>

                    <!-- Form Group -->
                    <div class="form-group">
                        <?= $this->Form->input('Email', array(
                                'class' => 'form-control',
                                'placeholder' => 'Email',
                                'type' => 'email',
                                'label' => 'Email',
                                'id' => 'email-1',
                                'aria-describedby' => 'email-1',
                            )); ?>
                    </div>
                    <!-- /form group -->

                    <!-- Form Group -->
                    <div class="form-group">
                        <?= $this->Form->input('Password', array(
                                'class' => 'form-control',
                                'placeholder' => 'Password',
                                'type' => 'password',
                                'label' => 'Mot de Passe',
                                'id' => 'password-1',
                            )); ?>
                    </div>
                    <!-- /form group -->


                    <!-- Form Group -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-uppercase">Connexion</button>
                    </div>
                    <!-- /form group -->

                <?= $this->Form->end(); ?>
                <!-- /form -->

            </div>
            <!-- /login content inner -->

        </div>
        <!-- /login content section -->

    </div>
    <!-- /login content -->

</div>        
</div>        
    </div>
    <!-- /root -->

        
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

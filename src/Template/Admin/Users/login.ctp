<!doctype html>
<html lang="fr" class="no-js">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="Administration">
    <meta name="author" content="JOBS CONSEIL">
    <meta name="theme-color" content="#3e454c">
    <?= $this->fetch('meta') ?>

    <title>Les Transports Citadins | Admin</title>

    <!-- Font awesome -->
    <?= $this->Html->css('admin/css/font-awesome.min.css') ?>
    <!-- Sandstone Bootstrap CSS -->
    <?= $this->Html->css('admin/css/bootstrap.min.css') ?>
    <!-- Bootstrap Datatables -->
    <?= $this->Html->css('admin/css/dataTables.bootstrap.min.css') ?>
    <!-- Bootstrap social button library -->
    <?= $this->Html->css('admin/css/bootstrap-social.css') ?>
    <!-- Bootstrap select -->
    <?= $this->Html->css('admin/css/bootstrap-select.css') ?>
    <!-- Bootstrap file input -->
    <?= $this->Html->css('admin/css/fileinput.min.css') ?>
    <!-- Awesome Bootstrap checkbox -->
    <?= $this->Html->css('admin/css/awesome-bootstrap-checkbox.css') ?>
    <!-- Admin Stye -->
    <?= $this->Html->css('admin/css/style.css') ?>
    <?= $this->fetch('css') ?>

    <link rel="shortcut icon" href="/img/icone-ltc.png">

</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(http://transports-citadins.jobs-conseil.com/images/banner-ltc-6.JPG);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3" style="background-color: rgba(228,228,228,0.94); border: 1px white; margin-top: 10%;">
                        <h1 class="text-center text-bold text-light mt-4x" style="color: black;">Connexion</h1>
                        <?= $this->Flash->render() ?>
							<div class="col-md-8 col-md-offset-2">
                            <?= $this->Form->create('User', ['url' => ['Controller' => 'Users','action' => 'login']]); ?>
                                <?= $this->Form->input('Email', array(
                                        'class' => 'form-control white_bg',
                                        'placeholder' => 'Email',
                                        'type' => 'text',
                                        'label' => 'Email',
                                    )); ?>
                                <?= $this->Form->input('Password', array(
                                        'class' => 'form-control white_bg',
                                        'placeholder' => 'Mot de passe',
                                        'type' => 'password',
                                        'label' => 'Mot de Passe',
                                    )); ?>
                                <br> <br>
                                <div class="form-group" style="text-align:center">
                                    <?= $this->Form->input('Connexion', array(
                                        'class' => 'btn btn-primary',
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
		</div>
	</div>
	
<!-- Loading Scripts -->
<?= $this->Html->script('http://code.jquery.com/jquery.min.js') ?>
<?= $this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0/js/bootstrap-select.min.js') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js') ?>
<?= $this->Html->script('admin/js/fileinput.js') ?>
<?= $this->Html->script('admin/js/chartData.js') ?>
<?= $this->Html->script('admin/js/main.js') ?>

</body>

</html>
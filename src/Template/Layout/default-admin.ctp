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
<div class="brand clearfix">
    <div class="logo"> <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>/" style="font-size: 14px;"><img src="/img/icone-ltc.png" alt="Les Transports Citadins"/> Les Transports Citadins</a></div>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">

        <li class="ts-account">
            <a href="#"><img src="/img/icone-ltc.png" class="ts-avatar hidden-side" alt=""> Admin <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword']) ?>">Modifier Mot de Passe</a></li>
                <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
            </ul>
        </li>
    </ul>
</div>


<div class="ts-main-content">
    <nav class="ts-sidebar">
        <ul class="ts-sidebar-menu">

            <li class="ts-label">Menu</li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>/"><i class="fa fa-dashboard"></i> Tableau de Bord</a></li>

            <li><a href="#"><i class="fa fa-files-o"></i> Marque</a>
                <ul>
                    <li><a href="<?= $this->Url->build(['controller' => 'Marques', 'action' => 'add']) ?>">Créer une Marque</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Marques', 'action' => 'index']) ?>">Gestion des Marques</a></li>
                </ul>
            </li>

            <li><a href="#"><i class="fa fa-sitemap"></i> Véhicules</a>
                <ul>
                    <li><a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'add']) ?>">Enregistrer un véhicule</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'index']) ?>">Gestion des Véhicules</a></li>
                </ul>
            </li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservations']) ?>"><i class="fa fa-users"></i> Gestion des Réservations</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'listClient']) ?>"><i class="fa fa-users"></i> Clients</a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'temoignages']) ?>"><i class="fa fa-table"></i> Gestion des Témoignages</a></li>
        </ul>
    </nav>

    <?= $this->fetch('content') ?>

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

<script>

    window.onload = function(){

        // Line chart from swirlData for dashReport
        var ctx = document.getElementById("dashReport").getContext("2d");
        window.myLine = new Chart(ctx).Line(swirlData, {
            responsive: true,
            scaleShowVerticalLines: false,
            scaleBeginAtZero : true,
            multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
        });

        // Pie Chart from doughutData
        var doctx = document.getElementById("chart-area3").getContext("2d");
        window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

        // Dougnut Chart from doughnutData
        var doctx = document.getElementById("chart-area4").getContext("2d");
        window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

    }
</script>
</body>
</html>
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">

                <h2 class="page-title">Tableau de Bord</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-primary text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 "><?php echo htmlentities($users->count());?></div>
                                            <div class="stat-panel-title text-uppercase">Clients</div>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'listClient']) ?>" class="block-anchor panel-footer text-center">+ Details <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-success text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 "><?php echo htmlentities($vehicules->count());?></div>
                                            <div class="stat-panel-title text-uppercase">Véhicules</div>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'index']) ?>" class="block-anchor panel-footer text-center">+ Details &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-info text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 "><?php echo htmlentities($reservations->count());?></div>
                                            <div class="stat-panel-title text-uppercase">Réservations</div>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'reservations']) ?>" class="block-anchor panel-footer text-center">+ Details &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-warning text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 "><?php echo htmlentities($marques->count());?></div>
                                            <div class="stat-panel-title text-uppercase">Marques</div>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Marques', 'action' => 'index']) ?>" class="block-anchor panel-footer text-center">+ Details &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">


                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-info text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 "><?php echo htmlentities($temoignages->count());?></div>
                                            <div class="stat-panel-title text-uppercase">Témoignages</div>
                                        </div>
                                    </div>
                                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'temoignages']) ?>" class="block-anchor panel-footer text-center">+ Details &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
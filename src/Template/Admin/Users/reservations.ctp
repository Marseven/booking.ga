<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Liste des réservations</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Infos des réservations</div>
                    <div class="panel-body">
                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Réference</th>
                                    <th>Client</th>
                                    <th>Véhicule</th>
                                    <th>Date de Départ</th>
                                    <th>Date de Retour</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                    <th>Mode de Paiement</th>
                                    <th>Date de Réservation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Réference</th>
                                    <th>Client</th>
                                    <th>Véhicule</th>
                                    <th>Date de Départ</th>
                                    <th>Date de Retour</th>
                                    <th>Prix</th>
                                    <th>Status</th>
                                    <th>Mode de Paiement</th>
                                    <th>Date de Réservation</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($reservations as $reservation){	?>	
                                <tr>
                                    <td><?php echo htmlentities($reservation->id);?></td>
                                    <td><?php echo htmlentities($reservation->reference);?></td>
                                    <td><?php echo htmlentities($reservation->user->FirstName);?> <?php echo htmlentities($reservation->user->LastName);?></td>
                                    <td><a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'edit', 'vehicule' => $reservation->vehicule->id]) ?>"><?php echo htmlentities($reservation->vehicule->marque->BrandName);?>, <?php echo htmlentities($reservation->vehicule->VehiclesTitle);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($reservation->FromDate));?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($reservation->ToDate));?></td>
                                    <td><?php echo htmlentities($reservation->Price);?></td>
                                    <td><?php echo htmlentities($reservation->Status);?></td>
                                    <td><?php echo htmlentities($reservation->Payment);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($reservation->PostingDate));?></td>
                                    <td><a target="_blank" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'printed', 'reference' => $reservation->reference]) ?>"><i class="glyphicon glyphicon-print"></i></a> 
                                        <?php if ($reservation->Realiser == 0) { ?>
                                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'realiser', 'reference' => $reservation->reference]) ?>">
                                                <button>Réalisée</button>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
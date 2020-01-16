<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Gestion des Véhicules</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Détails du Véhicule</div>
                    <div class="panel-body">
                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>#</th>
                                    <th>Titre</th>
                                    <th>Marque </th>
                                    <th>Prix par Jour</th>
                                    <th>Consommation</th>
                                    <th>Nombre</th>
                                    <th>Nombre Réel</th>
                                    <th>Année</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>Titre</th>
                                    <th>Marque </th>
                                    <th>Prix par Jour</th>
                                    <th>Consommation</th>
                                    <th>Nombre</th>
                                    <th>Nombre Réel</th>
                                    <th>Année</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($vehicules as $vehicule){	?>	
                                <tr>
                                    <td><?php echo htmlentities($vehicule->id);?></td>
                                    <td><?php echo htmlentities($vehicule->VehiclesTitle);?></td>
                                    <td><?php echo htmlentities($vehicule->marque->BrandName);?></td>
                                    <td><?php echo htmlentities($vehicule->PricePerDay);?></td>
                                    <td><?php echo htmlentities($vehicule->FuelType);?></td>
                                    <td><?php echo htmlentities($vehicule->Nombre);?></td>
                                    <td><?php echo htmlentities($vehicule->Nombre_reel);?></td>
                                    <td><?php echo htmlentities($vehicule->ModelYear);?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'edit', 'vehicule' => $vehicule->id]) ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="<?= $this->Url->build(['controller' => 'Vehicules', 'action' => 'delete', 'vehicule' => $vehicule->id]) ?>" onclick="return confirm('Voulez-vous vraiment le supprimé');"><i class="fa fa-close"></i></a>
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
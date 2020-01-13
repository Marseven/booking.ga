<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Gestion des Marques</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Liste de Marque</div>
                    <div class="panel-body">
                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Marque</th>
                                    <th>Date de création</th>
                                    <th>Date de modification</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Marque</th>
                                    <th>Date de création</th>
                                    <th>Date de modification</th>
                                    <th>Action</th>
                                </tr>
                                </tr>
                            </tfoot>
                            <tbody>

                            <?php foreach($marques as $marque){	?>	
                                <tr>
                                    <td><?php echo htmlentities($marque->id);?></td>
                                    <td><?php echo htmlentities($marque->BrandName);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($marque->CreationDate));?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($marque->UpdationDate));?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Marques', 'action' => 'edit', 'marque' => $marque->id]) ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="<?= $this->Url->build(['controller' => 'Marques', 'action' => 'delete', 'marque' => $marque->id]) ?>" onclick="return confirm('Êtes-vous sûr de voulir supprimer cette marque');"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                             <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
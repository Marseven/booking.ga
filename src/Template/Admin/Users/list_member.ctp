<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Clients Enregistrés</h2>
                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Clients <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'export']) ?>">Expoter en CSV</a></div>
                    <div class="panel-body">
                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>#</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date de Naissance</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>Province</th>
                                    <th>Pays</th>
                                    <th>Date d'enregistrement</th>
                                
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date de Naissance</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>Province</th>
                                    <th>Pays</th>
                                    <th>Date d'enregistrement</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($users as $user){	?>	
                                <tr>
                                    <td><?php echo htmlentities($user->id);?></td>
                                    <td><?php echo htmlentities($user->FirstName);?> <?php echo htmlentities($user->LastName);?></td>
                                    <td><?php echo htmlentities($user->Email);?></td>
                                    <td><?php echo htmlentities($user->ContactNo);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($user->BornDate));?></td>
                                    <td><?php echo htmlentities($user->Address);?></td>
                                    <td><?php echo htmlentities($user->City);?></td>
                                    <td><?php echo htmlentities($user->Province);?></td>
                                    <td><?php echo htmlentities($user->Country);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($user->RegDate));?></td>
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
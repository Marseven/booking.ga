<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Gestion des Témoignages</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">Témoignages des Clients</div>
                    <div class="panel-body">
                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>#</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Témoigneges</th>
                                    <th>Date d'envoie</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nom & Prénom</th>
                                    <th>Email</th>
                                    <th>Témoigneges</th>
                                    <th>Date d'envoie</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            <?php foreach($temoignages as $temoignage){	?>	
                                <tr>
                                    <td><?php echo htmlentities($temoignage->id);?></td>
                                    <td><?php echo htmlentities($temoignage->user->FirstName);?> <?php echo htmlentities($temoignage->user->LastName);?></td>
                                    <td><?php echo htmlentities($temoignage->user->Email);?></td>
                                    <td><?php echo htmlentities($temoignage->Testimonial);?></td>
                                    <td><?php echo htmlentities(\App\Controller\AppController::change_format_date($temoignage->PostingDate));?></td>
                                    <td><?php if($temoignage->status=="" || $temoignage->status==0){?>
                                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'moderer', 'aid' => $temoignage->id]) ?>" onclick="return confirm('Voulez-vous vraiment activer ce témoignage')"> Activer</a>
                                        <?php } else {?>

                                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'moderer', 'iid' => $temoignage->id]) ?>" onclick="return confirm('Voulez-vous vraiment déscativer ce témoignage')"> Désactiver</a>
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
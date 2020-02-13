<?= $this->Html->css('../admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css', ['block' => true]) ?>

<?= $this->Flash->render() ?>

<div class="dt-page__header">
    <h1 class="dt-page__title">Gestion des Trains</h1>
</div>
<!-- /page header -->

<!-- Grid -->
<div class="row">

    <!-- Grid Item -->
    <div class="col-xl-12">

        <!-- Entry Header -->
        <div class="dt-entry__header">

            <!-- Entry Heading -->
            <div class="dt-entry__heading">
                <h3 class="dt-entry__title">Trains</h3>
            </div>
            <!-- /entry heading -->

        </div>
        <!-- /entry header -->

        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body">

                <!-- Tables -->
                <div class="table-responsive">

                    <table id="data-table"
                           class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Catégorie </th>
                                <th>Jour</th>
                                <th>Nombre Place</th>
                                <th>Nombre Wagon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($trains as $train){	?>	
                                <tr class="gradeX">
                                    <td><?php echo htmlentities($train->id);?></td>
                                    <td><?php echo htmlentities($train->VehiclesTitle);?></td>
                                    <td><?php echo htmlentities($train->categorie->libelle);?></td>
                                    <td><?php echo htmlentities($train->semaine->jour);?></td>
                                    <td><?php echo htmlentities($train->NombrePlace);?></td>
                                    <td><?php echo htmlentities($train->NombreVagon);?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Trains', 'action' => 'edit', 'train' => $train->id]) ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="<?= $this->Url->build(['controller' => 'Trains', 'action' => 'delete', 'train' => $train->id]) ?>" onclick="return confirm('Voulez-vous vraiment le supprimé');"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            <?php } ?> 
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Catégorie </th>
                                <th>Jour</th>
                                <th>Nombre Place</th>
                                <th>Nombre Wagon</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
                <!-- /tables -->

            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->

    </div>
    <!-- /grid item -->

</div>
<!-- /grid -->                    </div>

<?= $this->Html->script('../admin/plugins/datatables.net/js/jquery.dataTables.js', ['block' => true]) ?>
<?= $this->Html->script('../admin/plugins/datatables.net-bs4/js/dataTables.bootstrap4.js', ['block' => true]) ?>
<?= $this->Html->script('../admin/js/global/data-table.js', ['block' => true]) ?>
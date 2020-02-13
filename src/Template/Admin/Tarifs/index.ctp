<?= $this->Html->css('../admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css', ['block' => true]) ?>

<?= $this->Flash->render() ?>

<div class="dt-page__header">
    <h1 class="dt-page__title">Gestion des Tarifs</h1>
</div>
<!-- /page header -->

<!-- Grid -->
<div class="row">

    <!-- Grid Item -->
    <div class="col-12">

        <!-- Card -->
        <div class="dt-card">

            <!-- Card Header -->
            <div class="dt-card__header">

                <!-- Card Heading -->
                <div class="dt-card__heading">
                    <h3 class="dt-card__title"><?= isset($tarif) ? 'Ajouter' : 'Modifier' ?> un tarif</h3>
                </div>
                <!-- /card heading -->

            </div>
            <!-- /card header -->

            <!-- Card Body -->
            <div class="dt-card__body">

                <!-- Form -->
                <?php if(isset($edit_tarif)){ $tarif = $edit_tarif; $action = "edit"; }else{ $action = "add";} ?>
                <?= $this->Form->create($tarif, ['url' => ['controller' => 'Tarifs', 'action' => $action ]]); ?>
                    <?= $this->Form->control('id_user', array(
                        'class' => 'form-control',
                        'type' => 'hidden',
                        'label' => '',
                        'value' => $user->id,
                    )); ?>
                    <div class="form-row">
                        <div class="col-sm-4 mb-3">
                            <?= $this->Form->control('depart', array(
                                'options' => $villes,
                                'class' => 'form-control',
                                'placeholder' => 'Départ',
                                'label' => '',
                            )); ?>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <?= $this->Form->control('arriver', array(
                                'options' => $villes,
                                'class' => 'form-control',
                                'placeholder' => 'Arrivée',
                                'label' => '',
                            )); ?>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="input-group">
                                <?= $this->Form->control('prix', array(
                                    'class' => 'form-control',
                                    'type' => 'number',
                                    'placeholder' => 'Prix',
                                    'label' => '',
                                )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 mb-3">
                            <?= $this->Form->control('id_classe', array(
                                'options' => $classes,
                                'class' => 'form-control',
                                'label' => '',
                            )); ?>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <?= $this->Form->control('id_categorie', array(
                                'options' => $categories,
                                'class' => 'form-control',
                                'placeholder' => 'Categorie',
                                'label' => '',
                            )); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?= isset($tarif) ? 'Ajouter' : 'Modifier' ?></button>
                    </div>
                <?= $this->Form->end(); ?>
                <!-- /form -->

            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->

    </div>
    <!-- /grid item -->

    <!-- Grid Item -->
    <div class="col-xl-12">

        <!-- Entry Header -->
        <div class="dt-entry__header">

            <!-- Entry Heading -->
            <div class="dt-entry__heading">
                <h3 class="dt-entry__title">Tarifs</h3>
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
                                <th>Départ</th>
                                <th>Arrivé</th>
                                <th>Catégorie</th>
                                <th>Classe</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($Tarifs as $tarif){	?>	
                                <tr class="gradeX">
                                    <td><?php echo htmlentities($tarif->id);?></td>
                                    <td><?php echo htmlentities($tarif->Ville->libelle);?></td>
                                    <td><?php echo htmlentities($tarif->Ville->libelle);?></td>
                                    <td><?php echo htmlentities($tarif->categorie->libelle);?></td>
                                    <td><?php echo htmlentities($tarif->Classe->libelle);?></td>
                                    <td><?php echo htmlentities($tarif->prix);?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Tarifs', 'action' => 'edit', 'tarif' => $tarif->id]) ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="<?= $this->Url->build(['controller' => 'Tarifs', 'action' => 'delete', 'tarif' => $tarif->id]) ?>" onclick="return confirm('Voulez-vous vraiment le supprimé');"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            <?php } ?> 
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Départ</th>
                                <th>Arrivé</th>
                                <th>Catégorie</th>
                                <th>Classe</th>
                                <th>Prix</th>
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
<?= $this->Html->css('../admin/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css', ['block' => true]) ?>

<?= $this->Flash->render() ?>

<div class="dt-page__header">
    <h1 class="dt-page__title">Gestion des Catégories de Trains</h1>
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
                    <h3 class="dt-card__title"><?= isset($categorie) ? 'Ajouter' : 'Modifier' ?> une catégorie</h3>
                </div>
                <!-- /card heading -->

            </div>
            <!-- /card header -->

            <!-- Card Body -->
            <div class="dt-card__body">

                <!-- Form -->
                <?php if(isset($edit_categorie)){ $categorie = $edit_categorie; $action = "edit"; }else{ $action = "add";} ?>
                <?= $this->Form->create($categorie, ['url' => ['controller' => 'Categories', 'action' => $action], 'class' => 'form-inline']); ?>
                    <div class="form-group mr-2">
                    <?= $this->Form->control('libelle', array(
                        'class' => 'form-control',
                        'type' => 'text',
                        'placeholder' => 'Libellé',
                        'label' => '',
                    )); ?>
                    </div>
                    <?= $this->Form->control('id_user', array(
                        'class' => 'form-control',
                        'type' => 'hidden',
                        'label' => '',
                        'value' => $user->id,
                    )); ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?= isset($categorie) ? 'Ajouter' : 'Modifier' ?></button>
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
                <h3 class="dt-entry__title">Catégories</h3>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($categories as $categorie){	?>	
                                <tr class="gradeX">
                                    <td><?php echo htmlentities($categorie->id);?></td>
                                    <td><?php echo htmlentities($categorie->libelle);?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'categories', 'action' => 'edit', 'categorie' => $categorie->id]) ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="<?= $this->Url->build(['controller' => 'categories', 'action' => 'delete', 'categorie' => $categorie->id]) ?>" onclick="return confirm('Voulez-vous vraiment le supprimé');"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            <?php } ?> 
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
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
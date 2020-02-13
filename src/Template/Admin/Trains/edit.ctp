<?= $this->Flash->render() ?>

<div class="dt-page__header">
    <h1 class="dt-page__title">Gestion des Trains</h1>
</div>
<!-- /page header -->

<div class="row">
        
    <!-- Grid Item -->
    <div class="col-12">

    <!-- Card -->
    <div class="dt-card">

        <!-- Card Header -->
        <div class="dt-card__header">

            <!-- Card Heading -->
            <div class="dt-card__heading">
                <h3 class="dt-card__title">Modifier un train</h3>
            </div>
            <!-- /card heading -->

        </div>
        <!-- /card header -->

        <!-- Card Body -->
        <div class="dt-card__body">

            <!-- Form -->
            <?= $this->Form->create($edit_train, ['type' => 'file']); ?>
                <div class="form-row">
                    <div class="col-sm-4 mb-3">
                        <?= $this->Form->input('Title', array(
                            'class' => 'form-control',
                            'placeholder' => 'Nom du Train',
                            'type' => 'text',
                            'label' => '',
                            'required'
                        )); ?>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <?= $this->Form->control('id_categorie', array(
                            'options' => $categories,
                            'class' => 'form-control',
                            'placeholder' => 'Jour',
                            'label' => '',
                            'required',
                        )); ?>
                    </div>
                    <div class="col-sm-4 mb-3">
                    <?= $this->Form->control('id_semaine', array(
                                    'options' => $semaines,
                                    'class' => 'form-control',
                                    'label' => '',
                                    'required',
                                )); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-4 mb-3">
                        <?= $this->Form->control('NombrePlace', array(
                            'class' => 'form-control',
                            'type' => 'number',
                            'placeholder' => 'Nombre de Place',
                            'label' => '',
                        )); ?>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <?= $this->Form->control('NombreVagon', array(
                            'class' => 'form-control',
                            'type' => 'number',
                            'placeholder' => 'Nombre de Place',
                            'label' => '',
                        )); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-3 mb-3">
                        <label for="validationDefault03">image 1</label>
                        <?= $this->Form->control('Timage1', array(
                            'class' => 'form-control',
                            'type' => 'file',
                            'label' => '',
                            'required',
                        )); ?>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <label for="validationDefault04">Image 2</label>
                        <?= $this->Form->control('Timage2', array(
                            'class' => 'form-control',
                            'type' => 'file',
                            'label' => '',
                        )); ?>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Ajouter</button>
            <?= $this->Form->end(); ?>
            <!-- /form -->

        </div>
        <!-- /card body -->

    </div>
    <!-- /card -->

    </div>
    <!-- /grid item -->
</div>
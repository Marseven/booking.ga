<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">
                <h2 class="page-title">Modifier une Marque</h2>

                <div class="row">
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <?= $this->Form->create($marque); ?>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nom de la Marque</label>
                                        <div class="col-sm-8">
                                        <?= $this->Form->input('BrandName', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Nom de la Marque',
                                            'type' => 'text',
                                            'label' => '',
                                            'required'
                                        )); ?>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4">
                                            <?= $this->Form->input('Valider', array(
                                                'class' => 'btn btn-primary',
                                                'id'    => 'Enregistrer',
                                                'type'  => 'submit',
                                                'label' => ''
                                            )); ?>
                                        </div>
                                    </div>
                                    <br><br>
                                <?= $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?= $this->Flash->render() ?>
            <div class="col-md-12">

                <h2 class="page-title">Enregistrer un véhicule</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Informations de Base</div>
                            <div class="panel-body">
                                <?= $this->Form->create('Vehicule', ['type' => 'file', 'class' => 'form-horizontal']); ?>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label">Titre<span style="color:red">*</span></label>
                                        <?= $this->Form->input('VehiclesTitle', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Nom du véhicule',
                                            'type' => 'text',
                                            'label' => '',
                                            'required'
                                        )); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Marque<span style="color:red">*</span></label>
                                        <?= $this->Form->input('VehiclesBrand', array(
                                            'options' => $marques,
                                            'class' => 'form-control',
                                            'label' => '',
                                        )); ?>
                                    </div>
                                </div>                            
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <label class="control-label">Description du véhicule<span style="color:red">*</span></label>
                                        <?= $this->Form->input('VehiclesOverview', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Description du véhicule',
                                            'type' => 'textarea',
                                            'rows' => 3,
                                            'label' => '',
                                            'required'
                                        )); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label">Nombre de Voitures Disponibles dans le Parc</label>
                                        <?= $this->Form->input('Nombre', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Nombre de véhicule',
                                            'type' => 'number',
                                            'label' => '',
                                            'required'
                                        )); ?>
                                        <div class="col-sm-6">
                                            <label class="control-label">Prix par Jour<span style="color:red">*</span></label>
                                            <?= $this->Form->input('PricePerDay', array(
                                                'class' => 'form-control',
                                                'placeholder' => 'Prix par jour',
                                                'type' => 'text',
                                                'label' => '',
                                                'required'
                                            )); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">                                                                       
                                    <div class="col-sm-6">
                                        <label class="control-label">Prix par Heure</label>
                                        <?= $this->Form->input('PricePerHour', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Prix par heure',
                                            'type' => 'text',
                                            'label' => '',
                                        )); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Selectionner le Type de Consommmation<span style="color:red">*</span></label>
                                        <?= $this->Form->input('FuelType', array(
                                            'options' => [
                                                'Petrol' => 'Petrol',
                                                'Diesel' => 'Diesel',
                                                'Essence' => 'Essence',
                                            ],
                                            'class' => 'form-control',
                                            'label' => '',
                                        )); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="control-label">Selectionner le Type de véhicule<span style="color:red">*</span></label>
                                        <?= $this->Form->input('Type', array(
                                            'options' => [
                                                '4x4 Standard' => '4x4 Standard',
                                                '4x4 Luxe' => '4x4 Luxe',
                                                '4x4 Utilitaire' => '4x4 Utilitaire',
                                                '4x4 Mini' => '4x4 Mini',
                                                'Bus' => 'Bus',
                                                'Mini Bus' => 'Mini Bus',
                                                'Berline Stardard' => 'Berline Stardard',
                                                'Berline Luxe' => 'Berline Luxe'
                                            ],
                                            'class' => 'form-control',
                                            'label' => '',
                                        )); ?>
                                    </div>
                                </div>
                               <div class="form-group">                                    
                                    <div class="col-sm-6">
                                        <label class="control-label">Nombre de Sièges<span style="color:red">*</span></label>
                                        <?= $this->Form->input('SeatingCapacity', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Nombre de siège',
                                            'type' => 'text',
                                            'label' => '',
                                            'required'
                                        )); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Puissance<span style="color:red">*</span></label>
                                        <?= $this->Form->input('Puissance', array(
                                            'class' => 'form-control',
                                            'placeholder' => 'Puissance',
                                            'type' => 'number',
                                            'label' => '',
                                            'required'
                                        )); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <h4><b>Télécharger des Images</b></h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        Image 1 <span style="color:red">*</span><input class="form-control" type="file" name="Vimage1" required>
                                        <br><br>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 2<span style="color:red">*</span><input class="form-control" type="file" name="Vimage2">
                                        <br><br>
                                    </div>
                                </div>
                                <div class="hr-dashed"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Accessoires</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox"  name="Transmission" />
                                    <label> Automatique </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:4%">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button class="btn btn-default" type="reset">Annuler</button>
                                <br><br>
                                <?= $this->Form->input('Enregistrer', array(
                                    'class' => 'btn btn-primary',
                                    'type'  => 'submit',
                                    'label' => '',
                                )); ?>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
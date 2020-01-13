<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Liste des Annonces</h4>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="max-height: 1000px; overflow: auto;">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($newsletters as $newsletter){ ?>
                    <tr>
                        <td><?= $newsletter->id ?></td>
                        <td><?= $newsletter->email ?></td>
                        <td><a href="<?= $this->Url->build(['controller' => 'Newsletters', 'action' => 'delete', 'email' => $newsletter->id]) ?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- End  Kitchen Sink -->
    </div>
</div>

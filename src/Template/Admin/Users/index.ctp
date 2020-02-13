<?= $this->Flash->render() ?>

<!-- Page Header -->
<div class="dt-page__header">
    <h1 class="dt-page__title">Tableau de Bord</h1>
</div>
<!-- /page header -->

<div class="row">

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-users dt-icon-bg bg-primary text-primary"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2"><?php echo htmlentities($users->count());?></span>
                    </div>
                    <div class="h5 mb-2">Clients</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-company dt-icon-bg bg-success text-success"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2"><?php echo htmlentities($trains->count());?></span>
                    </div>
                    <div class="h5 mb-2">Trains</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-customer dt-icon-bg bg-secondary text-secondary"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2"><?php echo htmlentities($reservations->count());?></span>
                    </div>
                    <div class="h5 mb-2">Réservations</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-revenue-new dt-icon-bg bg-orange text-orange"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2">34567</span>
                    </div>
                    <div class="h5 mb-2">Villes</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->
</div>
<!-- /grid -->

<div class="row">

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-users dt-icon-bg bg-primary text-primary"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2">2500</span>
                    </div>
                    <div class="h5 mb-2">Classes</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->

    <!-- Grid Item -->
    <div class="col-xl-3 col-sm-6">
        <!-- Card -->
        <div class="dt-card">

            <!-- Card Body -->
            <div class="dt-card__body d-flex flex-sm-column">
                <div class="mb-sm-7 mr-7 mr-sm-0">
                    <i class="icon icon-company dt-icon-bg bg-success text-success"></i>
                </div>
                <div class="flex-1">
                    <div class="d-flex align-items-center mb-2">
                        <span class="h2 mb-0 font-weight-500 mr-2">2,45,855</span>
                    </div>
                    <div class="h5 mb-2">Catégories</div>
                </div>
            </div>
            <!-- /card body -->

        </div>
        <!-- /card -->
    </div>
    <!-- /grid item -->
</div>
<!-- /grid -->
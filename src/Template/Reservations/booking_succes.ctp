<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-1">
                <div class="result-sorting-wrapper">
                    <div class="sorting-count">
                        <p><?= $result_message ?></p>
                        <p style="text-align: center;"><a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'index']) ?>">ACCUEIL</a> | <a target="_blank" href="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'printed', 'reference' => $reservation->reference]) ?>" >IMPRIMER LA FACTURE</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Listing-detail-->

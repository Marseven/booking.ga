<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <div class="listing_detail_head row">
            <h2>DETAILS DE LA RESERVATIONS</h2>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="listing_detail_head row">
                    <div class="col-md-6">
                        <h2><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></h2>
                    </div>
                    <div class="col-md-6">
                        <div class="price_info">
                            <p><?php echo htmlentities(\App\Controller\AppController::change_number_format($vehicule->PricePerDay));?> FCFA/J</p>
                            <p><?= $vehicule->PricePerHour == 0 ? '' : \App\Controller\AppController::change_number_format($vehicule->PricePerHour).' FCFA/H' ?></p>
                        </div>
                    </div>
                </div>
                <div class="main_features">
                    <div class="listing_more_info row">
                        <div class="listing_detail_wrap">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="component-content" style="padding: 20px;">
                                        <div>
                                            <div>
                                                <p>Du <strong class=""><?= $date_depart[0] ?> à <?= $date_depart[1] ?></strong></p>
                                                <p>Au <strong class=""><?= $date_arriver[0] ?> à <?= $date_arriver[1] ?></strong></p>
                                            </div>
                                            <p></p>
                                            <div>
                                                <p>Lieu de départ: <br> <strong class=""><?= $lieu_depart ?></strong></p>
                                                <p>Lieu de retour: <br> <strong class=""><?= $lieu_arriver ?></strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <ul>
                                            <li>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <p>Avec Chauffeur</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-tint" aria-hidden="true"></i>
                                                <p><?php echo htmlentities($vehicule->FuelType);?></p>
                                            </li>
                                        </ul>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <ul>
                                            <li>
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                <p><?php echo htmlentities($vehicule->SeatingCapacity);?> Sièges</p>
                                            </li>

                                            <li>
                                                <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                                                <p>Climatisatisé</p>
                                            </li>
                                            <li>
                                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                                <p><?= $vehicule->Transmission == 1 ? 'Automatique' : 'Manuel' ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table style="padding: 20px;">
                                    <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align="center">Jours</td>
                                        <td align="center">Prix net</td>
                                        <td align="center">Taxe</td>
                                        <td align="center">Prix total</td>
                                    </tr>
                                    <tr>
                                        <td align="center"><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></td>
                                        <td align="center"><?= $nbre_jour ?></td>
                                        <td align="center">
                                            <span class=""><?= \App\Controller\AppController::change_number_format($prix_total) ?></span>
                                            <span class="">Francs CFA</span>
                                        </td>
                                        <td align="center">
                                            <span class="">0</span>
                                            <span class="">Francs CFA</span>
                                        </td>
                                        <td align="center">
                                            <span class=""><?= \App\Controller\AppController::change_number_format($prix_total) ?></span>
                                            <span class="">Francs CFA</span>
                                        </td>
                                    </tr>
                                    <tr height="20px">
                                        <td colspan="5" height="20px">&nbsp;</td>
                                    </tr>
                                    <tr class="">
                                        <td align="center">Total</td>
                                        <td align="center"><?= $nbre_jour ?></td>
                                        <td align="center">
                                            <strong class=""><?= \App\Controller\AppController::change_number_format($prix_total) ?></strong>
                                            <span class="">Francs CFA</span>
                                        </td>
                                        <td align="center">
                                            <span class="">0</span>
                                            <span class="">Francs CFA</span>
                                        </td>
                                        <td align="center" class="">
                                            <strong class=""><?= \App\Controller\AppController::change_number_format($prix_total) ?></strong>
                                            <span class="">Francs CFA</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <form style="text-align: center;"  method="post" name="booking" action="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'gateway']) ?>">
                                    <input type="hidden" name="montant" value="<?= $prix_total ?>">
                                    <input type="hidden" name="lieu_depart" value="<?= $_SESSION['panier']['voiture']['lieu_depart'] ?>">
                                    <input type="hidden" name="lieu_arriver" value="<?= $_SESSION['panier']['voiture']['lieu_arriver'] ?>">
                                    <input type="hidden" name="date_depart" value="<?= $_SESSION['panier']['voiture']['date_depart'] ?>">
                                    <input type="hidden" name="date_arriver" value="<?= $_SESSION['panier']['voiture']['date_arriver'] ?>">
                                    <input type="hidden" name="voiture" value="<?= $vehicule->id ?>">
                                    <div class="divider"></div>
                                    <h6>Méthode de paiement</h6>
                                    <div class="form-group">
                                        <!--input type="radio" name="moyen_paiement" value="Visa">
                                        <label>Paypal <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" /></label>
                                        <br-->
                                        <input type="radio" name="moyen_paiement" checked value="Ebilling">
                                        <label>Ebilling Payment <img src="http://jobsmarket.jobs-conseil.com/wp-content/uploads/2017/07/airtel-moov-acheter.png"></label>
                                        <br>
                                        <input type="radio" name="moyen_paiement" value="Arriver">
                                        <label>Paiement à l'arrivée <i class="glyphicon glyphicon-auto"></i></label>
                                    </div>
                                    <div>
                                        <input type="submit" value="Continuer" name="Confirmer" id="submit" class="btn btn-sm btn-success">
                                        <a href="<?= $this->Url->build(['controller' => 'Transports', 'action' => 'vehiculeItem', 'vehicule' => $vehicule->id, 'reset' => 'true']) ?>"><button type="button" style="background-color: red; color: white;" class="btn btn-sm btn-danger">Annuler</button></a>
                                    </div>
                                </form>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <div class="listing_detail_head row">
            <h2>INFORMATONS DU CLIENT</h2>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="listing_detail_head row">
                    <div class="col-md-6">
                        <h2><?php echo htmlentities($vehicule->marque->BrandName);?> , <?php echo htmlentities($vehicule->VehiclesTitle);?></h2>
                    </div>
                    <div class="col-md-6">
                        <div class="price_info">
                            <p><?= \App\Controller\AppController::change_number_format($_SESSION['panier']['prix']) ?> </p> Francs CFA
                        </div>
                    </div>
                    <div class="divider"></div>
                </div>
                <h3>Paiement par eBilling</h3>
                <div class="main_features">
                    <div class="listing_more_info row">
                        <div class="signup_wrap">
                            <div class="col-md-12 col-sm-6">
                                <form  method="post" name="booking" action="<?= $this->Url->build(['controller' => 'Reservations', 'action' => 'ebilling']) ?>">
                                    <input type="hidden" name="lieu_depart" value="<?= $_SESSION['panier']['voiture']['lieu_depart'] ?>">
                                    <input type="hidden" name="lieu_arriver" value="<?= $_SESSION['panier']['voiture']['lieu_arriver'] ?>">
                                    <input type="hidden" name="date_depart" value="<?= $_SESSION['panier']['voiture']['date_depart'] ?>">
                                    <input type="hidden" name="date_arriver" value="<?= $_SESSION['panier']['voiture']['date_arriver'] ?>">
                                    <input type="hidden" name="montant" value="<?= $_SESSION['panier']['prix'] ?>">
                                    <input type="hidden" name="voiture" value="<?= $vehicule->id ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nom <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="nom" value="<?php if(isset($user)){ echo $user['FirstName'];} ?>" placeholder="Nom*" required="required">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Prénom <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="prenom" value="<?php if(isset($user)){echo $user['LastName'];} ?>" placeholder="Prénom" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>E-Mail <span style="color: red;">*</span></label>
                                                <input type="email" class="form-control" name="email" id="emailid" value="<?php if(isset($user)){echo $user['Email'];} ?>" placeholder="Adresse mail" required="required">
                                                <span id="user-availability-status" style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Téléphone <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="telephone" value="<?php if(isset($user)){echo $user['ContactNo'];} ?>" placeholder="Téléphone" maxlength="20" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Adresse</label>
                                                <input type="text" class="form-control" value="<?php if(isset($user)){echo $user['Address'];} ?>" name="adresse" placeholder="Adresse">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Code Postal</label>
                                                <input type="text" class="form-control" value="<?php if(isset($user)){echo $user['ZipCode'];} ?>" name="poste" placeholder="Code Postal">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Ville</label>
                                                <input type="text" class="form-control" value="<?php if(isset($user)){echo $user['City'];} ?>" name="ville" placeholder="Ville">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Province</label>
                                                <input type="text" class="form-control" value="<?php if(isset($user)){ echo $user['Province'];} ?>" name="province" placeholder="Département">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pays</label>
                                                <select class="form-control" name="pays">
                                                    <?php if(isset($user)){echo "<option>".$user['Contry']."</option>";} ?>
                                                    <option>Gabon </option>
                                                    <option>Cameroun</option>
                                                    <option>France</option>
                                                    <option>Etats-Unis</option>
                                                    <option>Japon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date de naissance <span style="color: red;">*</span></label>
                                                <input type="date" class="form-control" value="<?php if(isset($user)){echo $user['BornDate'];} ?>" name="date_naissance" placeholder="Date de naissance">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="moyen_paiement" value="Ebilling">
                                    <div>
                                        <input type="submit" value="Payer" name="Confirmer" id="submit" class="btn btn-small">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
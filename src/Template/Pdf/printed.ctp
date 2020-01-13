<div style="height: 20px; width:100%;">

</div>
<div class="container">
    <div style="border-radius: 5px; padding 5px; border: 2px solid rgba(85, 86, 98, 0.87); float: left; width: 40%; display: block; margin-right: 10px;">
      <div style="margin-left: 10px;">
          <p><img  src="/img/logo-ltc.png" alt="imglogo"/></p>
          <h4>Les Transports Citadins</h4>
      </div>
    </div>
      <div style="height: 10px; width:100%;">

    </div>
    <div>
      <table class="items" cellpadding="8" width="100%"  style="autosize: 2.4; border-collapse: collapse; border: 0;" >
          <thead>
            <tr>
                <td width="5%"><strong>Numéro de la réservation</strong></td>
                <td width="20%"><strong>Référence</strong></td>
                <td width="5%"><strong>Status de la commande</strong></td>
                <td width="15%"><strong>Date de la réservation</strong></td>
            </tr>
          </thead>
          <tbody>
              <tr>
                  <td><?=$contenu['id']?></td>
                  <td><?=$contenu['reference']?></td>
                  <td><?=$contenu['status']?></td>
                  <td><?=$contenu['date']?></td>
              </tr>
          </tbody>
      </table>
      <br>
      <h3>Détails Personnels</h3>
      <p>Nom  :  <?=$contenu['nom']?></p>
      <p>Prénom  :  <?=$contenu['prenom']?></p>
      <p>Téléphone : <?=$contenu['telephone']?></p>
      <p>Email :  <?=$contenu['email']?></p>
      <p>Date de naissance :  <?=$contenu['date_naissance']?></p>
    </div>

    <div style="height: 10px; width:100%;">

    </div>
    <div style="width: 100%; display: block; margin-right: 10px;">
      <h2>Voiture louée :  <?=$contenu['brand']?>, <?=$contenu['title']?> </h2>
      <br>
      <div style="text-align: center;">
          <table class="items" cellpadding="8" width="100%"  style="autosize: 2.4; border-collapse: collapse;" >
            <thead>
                <tr>
                    <td width="5%"><strong>Lieu de départ</strong></td>
                    <td width="20%"><strong>Date de départ</strong></td>
                    <td width="5%"><strong>Lieu de retour</strong></td>
                    <td width="15%"><strong>Date de retour</strong></td>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$contenu['lieu_depart']?></td>
                <td><?=$contenu['date_depart']?></td>
                <td><?=$contenu['lieu_arriver']?></td>
                <td><?=$contenu['date_arriver']?></td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>

    <div style="height: 10px; width:100%;">

    </div>
    <div >
      <table class="items" cellpadding="8" width="100%"  style="autosize: 2.4; border-collapse: collapse;" >
        <thead>
            <tr>
                <td style="border: 1px solid black;" width="5%"></td>
                <td style="border: 1px solid black;" width="20%">Jour</td>
                <td style="border: 1px solid black;" width="5%">Prix Net</td>
                <td style="border: 1px solid black;" width="15%">Taxes</td>
                <td style="border: 1px solid black;" width="15%">Prix Total</td>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td style="border: 1px solid black;"><?=$contenu['brand']?>, <?=$contenu['title']?></td>
            <td style="border: 1px solid black;"><?=$contenu['nbre_jour']?></td>
            <td style="border: 1px solid black;"><?=$contenu['prixJ']?> FCFA/J <br> <?=$contenu['prixH']?> FCFA/H</td>
            <td style="border: 1px solid black;"> 0 FCFA</td>
            <td style="border: 1px solid black;"><?=$contenu['montant']?> FCFA</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;"><strong>Total</strong></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?=$contenu['prixJ']?> FCFA/J <br> <?=$contenu['prixH']?> FCFA/H</td>
            <td style="border: 1px solid black;">0 FCFA</td>
            <td style="border: 1px solid black;"><?=$contenu['montant']?> FCFA</td>
            </tr>
          </tbody>
      </table>
    </div>
    <div style="height: 10px; width:100%;">

    </div>
    <div>
      <div style="margin-left: 10px;">
          <p> <?=$contenu['nom']?> <?=$contenu['prenom']?>, Pour plus de détails, visitez la page suivante: </p>
          <p><a href="http://transports-citadins.com">www.transports-citadins.com</a></p>
      </div>
    </div>
</div>
<?php

namespace App\Model\Table;

use App\Controller\AppController;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class ReservationsTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Users')
            ->setForeignKey('userEmail') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
            ->setJoinType('INNER');
        $this->belongsTo('Trains')
            ->setForeignKey('id') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
            ->setJoinType('INNER');
    }

   static function is_aviable($infos){
        $dispo = true;
        $reservationTable = TableRegistry::get('Reservations');

        $reservations = $reservationTable->find()
                                        ->where([
                                            'id' => $infos['tid'],
                                        ])
                                        ->all();

        $id=intval($infos['vid']);
        $vehiculeTable = TableRegistry::get('trains');

        $vehicule = $vehiculeTable->find()
                    ->where(
                        [
                            'id' => $id,
                        ]
                    )
                    ->all();
        if($reservations->first())
        {
            foreach($reservations as $q){
                $date_depart = new \DateTime($q->FromDate);
                $date_arriver = new \DateTime($q->ToDate);
                if(($infos['depart'] < $date_depart && $infos['arriver'] < $date_depart) || ($infos['depart'] > $date_depart && $infos['arriver'] > $date_depart && $infos['depart'] > $date_arriver && $infos['arriver'] > $date_arriver)) {
                    $dispo = true;
                    if ($vehicule->first()->Nombre_reel == 0) {
                        $dispo = false; 
                        break;
                    }
                }else{
                    if ($vehicule->first()->Nombre_reel > 0) {
                        $dispo = true;
                    }else{
                        $dispo = false;
                        break;
                    }
                }   
            }
        }else{
            return $dispo;
        }
        return $dispo;
    }

    static function data_reservation($reference){
        //récupérer la réservation et afficher le messages de succès!
        $reservationTable = TableRegistry::get('Reservations');
        $vehiculeTable = TableRegistry::get('Vehicules');
        $userTable = TableRegistry::get('Users');

        $reservation = $reservationTable->find()
            ->where([
                'reference' => $reference,
            ])
            ->all();
        $vhid=intval($reservation->first()->VehicleId);
        $vehicule = $vehiculeTable->find()
            ->contain('Marques')
            ->where([
                'Vehicules.id' => $vhid,
            ])
            ->all();
        $user = $userTable->find()
            ->where([
                'id' => $reservation->first()->userEmail,
            ])
            ->all();

        $aujourdhui = new \DateTime();
        $date_depart = new \DateTime($reservation->first()->FromDate);
        $date_arriver = new \DateTime($reservation->first()->ToDate);
        $date_naissance = new \DateTime($user->first()->BornDate);
        $date = new \DateTime($reservation->first()->PostingDate);
        if ($aujourdhui >= $date_depart || $date_depart >= $date_arriver || $aujourdhui >= $date_arriver) {
            $flash = array();
            $flash['type'] = 'danger';
            $flash['message'] = "Mauvaises Dates.";
            $_SESSION['flash'] = $flash;
            header('Location: index.php');
        }else{
            $nbre_jour_reserver = $date_arriver->diff($date_depart);
            $jour = (int)$nbre_jour_reserver->d;
            $heure = (int)$nbre_jour_reserver->h;
            $nbre_jour = $jour.' jour(s) & '.$heure.' Heure(s)';
        }
        $date_depart  = $date_depart->format('d-m-Y H:i');
        $date_naissance  = $date_naissance->format('d-m-Y');
        $date_arriver  = $date_arriver->format('d-m-Y H:i');
        $date  = $date->format('d-m-Y H:i');
        $contenu = array();
        $contenu =  [
            'id' => $reservation->first()->id,
            'reference' => $reservation->first()->reference,
            'status' => $reservation->first()->Status,
            'date' => $date,
            'prenom' => $user->first()->FirstName,
            'nom' => $user->first()->LastName,
            'email' => $user->first()->Email,
            'adresse' => $user->first()->Address,
            'ville' => $user->first()->City,
            'poste' => $user->first()->ZipCode,
            'pays' => $user->first()->Country,
            'telephone' => $user->first()->ContactNo,
            'date_naissance' => $date_naissance,
            'brand' => $vehicule->first()->marque->BrandName,
            'title' => $vehicule->first()->VehiclesTitle,
            'lieu_depart' => $reservation->first()->FromPlace,
            'lieu_arriver' => $reservation->first()->ToPlace,
            'date_depart' => $date_depart,
            'date_arriver' => $date_arriver,
            'montant' => $reservation->first()->Price,
            'moyen_paiement' => $reservation->first()->Payment,
            'prixJ' => $vehicule->first()->PricePerDay,
            'prixH' => $vehicule->first()->PricePerHour,
            'nbre_jour' => $nbre_jour,
            'jour' => $jour,
            'heure' => $heure,
        ];

        return $contenu;
    }

   static function data_reserver($reference){
        //récupérer la réservation et afficher le messages de succès!
        $reservationTable = TableRegistry::get('Reservations');
        $vehiculeTable = TableRegistry::get('Vehicules');
        $userTable = TableRegistry::get('Users');

        $reservation = $reservationTable->find()
            ->where([
                'reference' => $reference,
            ])
            ->all();
        $vhid=intval($reservation->first()->VehicleId);
        $vehicule = $vehiculeTable->find()
            ->contain('Marques')
            ->where([
                'Vehicules.id' => $vhid,
            ])
            ->all();
        $user = $userTable->find()
            ->where([
                'id' => $reservation->first()->userEmail,
            ])
            ->all();

        $date_depart = new \DateTime($reservation->first()->FromDate);
        $date_arriver = new \DateTime($reservation->first()->ToDate);
        $date_naissance = new \DateTime($user->first()->BornDate);
        $date = new \DateTime($reservation->first()->PostingDate);
        $nbre_jour_reserver = $date_arriver->diff($date_depart);
        $jour = (int)$nbre_jour_reserver->d;
        $heure = (int)$nbre_jour_reserver->h;
        $nbre_jour = $jour.' jour(s) & '.$heure.' Heure(s)';
        $date_depart  = $date_depart->format('d-m-Y H:i');
        $date_naissance  = $date_naissance->format('d-m-Y');
        $date_arriver  = $date_arriver->format('d-m-Y H:i');
        $date  = $date->format('d-m-Y H:i');
        $contenu = array();
        $contenu =  [
            'id' => $reservation->first()->id,
            'reference' => $reservation->first()->reference,
            'status' => $reservation->first()->Status,
            'date' => $date,
            'prenom' => $user->first()->FirstName,
            'nom' => $user->first()->LastName,
            'email' => $user->first()->Email,
            'adresse' => $user->first()->Address,
            'ville' => $user->first()->City,
            'poste' => $user->first()->ZipCode,
            'pays' => $user->first()->Country,
            'telephone' => $user->first()->ContactNo,
            'date_naissance' => $date_naissance,
            'brand' => $vehicule->first()->marque->BrandName,
            'title' => $vehicule->first()->VehiclesTitle,
            'lieu_depart' => $reservation->first()->FromPlace,
            'lieu_arriver' => $reservation->first()->ToPlace,
            'date_depart' => $date_depart,
            'date_arriver' => $date_arriver,
            'montant' => $reservation->first()->Price,
            'moyen_paiement' => $reservation->first()->Payment,
            'prixJ' => $vehicule->first()->PricePerDay,
            'prixH' => $vehicule->first()->PricePerHour,
            'nbre_jour' => $nbre_jour,
            'jour' => $jour,
            'heure' => $heure,
        ];

        return $contenu;
    }
}
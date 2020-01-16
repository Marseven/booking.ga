<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ReservationsTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;

Configure::write('CakePdf', [
    'engine' => 'CakePdf.Mpdf',
    'margin' => [
        'bottom' => 15,
        'left' => 50,
        'right' => 30,
        'top' => 45
    ],
    'orientation' => 'portrait',
    'download' => true
]);

class ReservationsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['booking', 'validateBooking', 'bookingSucces', 'arriver', 'ebilling', 'visa', 'ebillingNotif', 'gateway', 'printed']);
        $user = $this->Auth->user();
        if(isset($user)){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
        }

        if (!isset($_SESSION['panier']) || isset($this->request->params['?']['reset'])){
            $_SESSION['panier'] = array();
            $_SESSION['panier']['count']=0;
            $_SESSION['panier']['prix']=0;
            $_SESSION['panier']['train']= array();
        }

    }

    function menu(){
        $acc = '';
        $veh = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'veh' => $veh,
            'dms' => $dms,
        ));
    }

    public function reservationitem(){
        $this->menu();
        if(empty($this->request->params['?']['reference'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }

        $reservationTable = TableRegistry::get('reservations');

        $reservation = $reservationTable->find()
            ->where(
                [
                    'reference' => $this->request->params['?']['reference'],
                ]
            )
            ->all();

        if (!$reservation->first()) {
            $this->Flash->error('Cette reservation n\'existe pas.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else{
            $reservation = $reservation->first();
        }

        $this->set('reservation', $reservation);
    }

    public function booking(){
        $this->menu();
        if(empty($this->request->params['?']['train'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['train'];
        }

        $trainTable = TableRegistry::get('trains');

        $train = $trainTable->find()
            ->contain('Marques')
            ->where(
                [
                    'trains.id' => $id,
                ]
            )
            ->all();

        if (!$train->first()) {
            $this->Flash->error('Ce train n\'existe pas.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }else{
            $train = $train->first();
        }
        $trains_related = $trainTable->find()
            ->contain('Marques')
            ->where(
                [
                    'Type' => $train->Type,
                    'trains.id <>' => $train->id
                ]
            )
            ->limit(5)
            ->all();

        $this->set('train', $train);
        $this->set('trains_related', $trains_related);

    }

    public function validateBooking(){
        $reservationTable = TableRegistry::get('Reservations');
        if(empty($this->request->params['?']['train'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }else{
            $id = (int)$this->request->params['?']['train'];
        }
        if ($this->request->is('post')) {
            $infos = AppController::date_verified($_POST['date_depart'], $_POST['date_arriver']);
            if($infos == false){
                $this->Flash->error('Mauvaises Dates.');
                $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
            }else{
                $aujourdhui = date('Y-m-d H:m');
                $aujourdhui = new \DateTime($aujourdhui);
                $aujourdhui = $aujourdhui->add(new \DateInterval('PT2H'));
                $date_depart = new \DateTime($_POST['date_depart']);
                $date_arriver = new \DateTime($_POST['date_arriver']);

                $intervale = AppController::difference_temps($aujourdhui, $date_depart);
                if ($intervale < 2.00) {
                    $this->Flash->error('La réservation doit être effectué au moins 2 heures avant l\'heure de départ.');
                    $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
                }
                $infos['vid'] = $id;
                if(ReservationsTable::is_aviable($infos)){
                    $nbre_jour_reserver = $date_arriver->diff($date_depart);
                    $jour = (int)$nbre_jour_reserver->d;
                    $heure = (int)$nbre_jour_reserver->h;
                    $nbre_jour = $jour.' jour(s) & '.$heure.' Heure(s)';
                    $date_depart = explode(' ', $_POST['date_depart']);
                    $date_arriver = explode(' ', $_POST['date_arriver']);
                    $trainTable = TableRegistry::get('trains');

                    $train = $trainTable->find()
                        ->contain('Marques')
                        ->where(
                            [
                                'trains.id' => $id,
                            ]
                        )
                        ->all();
                    $train = $train->first();
                    if($train->PricePerHour != 0){
                    	$prix_total = ($jour*$train->PricePerDay)+($heure*$train->PricePerHour);
                    }else{
                    	$heure_cal = round(($heure/24), 2);
                		$prix_total = ($jour*$train->PricePerDay)+($heure_cal*$train->PricePerDay);
                    }
                    $_SESSION['panier']['prix'] = ($jour*$train->PricePerDay)+($heure*$train->PricePerHour);
                    $_SESSION['panier']['train']['lieu_depart'] =  $_POST['lieu_depart'];
                    $_SESSION['panier']['train']['lieu_arriver'] =  $_POST['lieu_arriver'];
                    $_SESSION['panier']['train']['date_depart'] =  $_POST['date_depart'];
                    $_SESSION['panier']['train']['date_arriver'] =  $_POST['date_arriver'];
                    $_SESSION['panier']['train']['id'] =  $id;
                    $_SESSION['panier']['count']=1;
                    $this->set('train', $train);
                    $this->set('prix_total', $prix_total);
                    $this->set([
                        'nbre_jour' => $nbre_jour,
                        'date_depart' => $date_depart,
                        'date_arriver' => $date_arriver,
                        'lieu_arriver' => $_POST['lieu_arriver'],
                        'lieu_depart' => $_POST['lieu_depart']
                    ]);
                }else{
                    $this->Flash->error('Ce modèle n\'est pas disponible pour cette période, Merci d\'essayer une autre période.');
                    $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
                }
            }
        }elseif(isset($_SESSION['panier']['train']) && !empty($_SESSION['panier']['train'])){
            $aujourdhui = date('Y-m-d H:m');

            $aujourdhui = new \DateTime($aujourdhui);
            $date_depart = new \DateTime($_SESSION['panier']['train']['date_depart']);
            $date_arriver = new \DateTime($_SESSION['panier']['train']['date_arriver']);

            $infos = array();
            $infos['depart'] = $date_depart;
            $infos['arriver'] = $date_arriver;
            $infos['vid'] = $id;
            if(ReservationsTable::is_aviable($infos)){
                $nbre_jour_reserver = $date_arriver->diff($date_depart);
                $jour = (int)$nbre_jour_reserver->d;
                $heure = (int)$nbre_jour_reserver->h;
                $nbre_jour = $jour.' jour(s) & '.$heure.' Heure(s)';
                $date_depart = explode(' ', $_SESSION['panier']['train']['date_depart']);
                $date_arriver = explode(' ', $_SESSION['panier']['train']['date_arriver']);
                $trainTable = TableRegistry::get('trains');

                $train = $trainTable->find()
                    ->contain('Marques')
                    ->where(
                        [
                            'trains.id' => $id,
                        ]
                    )
                    ->all();
                $train = $train->first();
                $prix_total = ($jour*$train->PricePerDay)+($heure*$train->PricePerHour);
                $this->set('train', $train);
                $this->set('prix_total', $prix_total);
                $this->set([
                    'nbre_jour' => $nbre_jour,
                    'date_depart' => $date_depart,
                    'date_arriver' => $date_arriver,
                    'lieu_arriver' => $_SESSION['panier']['train']['lieu_arriver'],
                    'lieu_depart' => $_SESSION['panier']['train']['lieu_depart']
                ]);
            }else{
                $this->Flash->error('Période déjà prise pour ce véhicule, Merci d\'essayer une autre période.');
                $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
            }

        }else{
            $this->Flash->error('Panier Vide.');
            $this->redirect(['controller' => 'Transports','action' => 'index', 'reset' => 'true']);
        }
    }

    public function gateway(){
        $moyen_paiement = '';
        if($this->request->is('post')){
            if($_POST['moyen_paiement'] == 'Ebilling'){
                $moyen_paiement = 'ebilling';
            }elseif($_POST['moyen_paiement'] == 'Visa'){
                $moyen_paiement = 'visa';
            }elseif($_POST['moyen_paiement'] == 'Arriver'){
                $moyen_paiement = 'arriver';
            }else{
                $this->redirect(['controller' => 'Transports','action' => 'index', 'reset' => 'true']);
            }


            echo "
            <form style=\"text-align: center;\"  method=\"post\" name=\"frm\" action=\"/reservations/".$moyen_paiement."\">
                <input type=\"hidden\" name=\"montant\" value=\"".$_POST['montant']."\">
                <input type=\"hidden\" name=\"lieu_depart\" value=\"". $_POST['lieu_depart'] ."\">
                <input type=\"hidden\" name=\"lieu_arriver\" value=\"". $_POST['lieu_arriver'] ."\">
                <input type=\"hidden\" name=\"date_depart\" value=\"". $_POST['date_depart'] ."\">
                <input type=\"hidden\" name=\"date_arriver\" value=\"". $_POST['date_arriver'] ."\">
                <input type=\"hidden\" name=\"train\" value=\"". $_POST['train'] ."\">
            </form>";
            echo "<script language='JavaScript'>";
            echo "document.frm.submit();";
            echo "</script>";
            exit();
        }

    }

    /**
     *
     */
    public function ebilling(){

        if (empty($_SESSION['panier']['train'])){
            $_SESSION['panier']['prix'] = $_POST['montant'];
            $_SESSION['panier']['train']['lieu_depart'] =  $_POST['lieu_depart'];
            $_SESSION['panier']['train']['lieu_arriver'] =  $_POST['lieu_arriver'];
            $_SESSION['panier']['train']['date_depart'] =  $_POST['date_depart'];
            $_SESSION['panier']['train']['date_arriver'] =  $_POST['date_arriver'];
            $_SESSION['panier']['train']['id'] =  $_POST['train'];
            $_SESSION['panier']['count']=1;
        }
        
        if ($this->request->is('post') && isset($_POST['moyen_paiement']) && $_POST['moyen_paiement'] == 'Ebilling') {
            // =============================================================
            // ===================== Setup Attributes ===========================
            // =============================================================
            // E-Billing server URL
            /*$SERVER_URL = "https://www.billing-easy.com/api/v1/merchant/e_bills";

            // Username
            $USER_NAME = '[USERNAME]';

            // SharedKey
            $SHARED_KEY = '[SHAREDKEY]';

            // POST URL
            $POST_URL = 'https://www.billing-easy.net';*/

            $SERVER_URL = "http://lab.billing-easy.net/api/v1/merchant/e_bills";

            // Username
            $USER_NAME = 'ltc';

            // SharedKey
            $SHARED_KEY = '44983837-14ad-4177-bd43-649cfbad0985';

            // POST URL
            $POST_URL = 'http://sandbox.billing-easy.net';

            // Check mandatory attributes have been supplied in Http Session
            if (empty($_POST['montant'])) die("Error : eb_amount_m parameter is not provided. ");
            if (empty($_POST['email'])) die("Error : eb_email_m parameter is not provided. ");
            if (empty($_POST['telephone'])) die("Error : eb_msisdn_m parameter is not provided. ");
            $reference = AppController::str_random(6);
            $trainTable = TableRegistry::get('trains');

            $train = $trainTable->find()
                ->contain(['Marques'])
                ->where(
                    [
                        'trains.id' => $_POST['train'],
                    ]
                )
                ->all();
            $train = $train->first();
            $aujourdhui = date('Y-m-d H:m');
            $aujourdhui = new \DateTime($aujourdhui);
            $aujourdhui = $aujourdhui->add(new \DateInterval('PT2H'));
            $date_depart = new \DateTime($_POST['date_depart']);
            $date_arriver = new \DateTime($_POST['date_arriver']);
            $nbre_jour_reserver = $date_arriver->diff($date_depart);
            $jour = (int)$nbre_jour_reserver->d;
            $heure = (int)$nbre_jour_reserver->h;

            // Fetch all data (including those not optional) from session
            $eb_amount = (int)$_SESSION['panier']['prix'];
            $eb_shortdescription = "Réservation chez Les Transports Citadins";
            $eb_reference = $reference;
            $eb_email = $_POST['email'];
            $eb_msisdn = $_POST['telephone'];
            $eb_name = $_POST['nom'] . ' ' . $_POST['prenom'];
            $eb_address = $_POST['adresse'];
            $eb_city = $_POST['ville'];
            $eb_detaileddescription = "Réservation d'une ".$train->marque->BrandName." ".$train->VehiclesTitle." pour une durée de ".$jour." jour(s) et ".$heure." heure(s).";
            $eb_additionalinfo = "Merci d'avoir réservé chez Les Tranports Citadins.";
            $eb_callbackurl = 'http://transports-citadins.jobs-conseil.com/reservations/bookingSucces/?get=Ebilling&ref='.$eb_reference;

            $date = date('Y-m-d H:m:s');

            // =============================================================
            // ============== E-Billing server invocation ==================
            // =============================================================
            $global_array =
                [
                    'payer_email' => $eb_email,
                    'payer_msisdn' => $eb_msisdn,
                    'amount' => $eb_amount,
                    'short_description' => $eb_shortdescription,
                    'description' => $eb_detaileddescription,
                    'due_date' => date('d/m/Y', time() + 86400),
                    'external_reference' => $eb_reference,
                    'payer_name' => $eb_name,
                    'payer_address' => $eb_address,
                    'payer_city' => $eb_city,
                    'additional_info' => $eb_additionalinfo
                ];


            $content = json_encode($global_array);
            $curl = curl_init($SERVER_URL);
            curl_setopt($curl, CURLOPT_USERPWD, $USER_NAME . ":" . $SHARED_KEY);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $json_response = curl_exec($curl);

            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
            }

            $connection = ConnectionManager::get('default');
            $date = date('Y-m-d H:m:s');
            $etat = "En Cours";
            $_POST['due_date'] = $date;
            $results = $connection->execute('INSERT INTO ebilling (email, phone, amount_order, description, date, external_reference, first_name, last_name, address, city, etat)
					 VALUES ("'.$global_array['payer_email'].'","'.$global_array['payer_msisdn'].'","'.$global_array['amount'].'","'.$global_array['short_description'].'","'.$date.'","'.$global_array['external_reference'].'","'.$_POST['nom'].'","'.$_POST['prenom'].'","'.$global_array['payer_address'].'","'.$global_array['payer_city'].'","'.$etat.'")');

            $userTable = TableRegistry::get('Users');

            $user = $userTable->find()
                ->where(
                    [
                        'Email' => $_POST['email'],
                    ]
                )
                ->all();

            if ($user->first()) {
                $user_edit = $userTable->newEntity();
                $user_edit->FirstName = $_POST['nom'];
                $user_edit->LastName = $_POST['prenom'];
                $user_edit->Email = $_POST['email'];
                $user_edit->Conctactno = $_POST['telephone'];
                $user_edit->BornDate = $_POST['date_naissance'];
                $user_edit->Address = $_POST['adresse'];
                $user_edit->City = $_POST['ville'];
                $user_edit->Country = $_POST['pays'];
                $user_edit->ZipCode = $_POST['poste'];
                $user_edit->Province = $_POST['province'];
                $user_edit->id = $user->first()->id;
                $userTable->save($user_edit);
                $_SESSION['panier']['train']['userEmail'] =  $user_edit->id;
            } else {
                $user = $userTable->newEntity();
                $user->FirstName = $_POST['nom'];
                $user->LastName = $_POST['prenom'];
                $user->Email = $_POST['email'];
                $user->Conctactno = $_POST['telephone'];
                $user->BornDate = $_POST['date_naissance'];
                $user->Address = $_POST['adresse'];
                $user->City = $_POST['ville'];
                $user->Country = $_POST['pays'];
                $user->ZipCode = $_POST['poste'];
                $user->Province = $_POST['province'];
                $userTable->save($user);
                $_SESSION['panier']['train']['userEmail'] =  $user->id;
            }

            $reservationTable = TableRegistry::get('Reservations');
            $reservation = $reservationTable->newEntity();
            $reservation->Status = 'En Traitement';
            $reservation->reference = $reference;
            $reservation->userEmail = $_SESSION['panier']['train']['userEmail'];
            $reservation->VehicleId = $_SESSION['panier']['train']['id'];
            $reservation->FromDate = $_SESSION['panier']['train']['date_depart'];
            $reservation->ToDate = $_SESSION['panier']['train']['date_arriver'];
            $reservation->FromPlace = $_SESSION['panier']['train']['lieu_depart'];
            $reservation->ToPlace = $_SESSION['panier']['train']['lieu_arriver'];
            $reservation->Price = $_SESSION['panier']['prix'];
            $reservation->Payment = 'Ebilling';
            $reservationTable->save($reservation);

            curl_close($curl);
            $response = json_decode($json_response, true);

            echo "<form action='" . $POST_URL . "' method='post' name='frm'>";
            echo "<input type='hidden' name='invoice_number' value='" . $response['e_bill']['bill_id'] . "'>";
            echo "<input type='hidden' name='eb_callbackurl' value='" . $eb_callbackurl . "'>";
            echo "</form>";
            echo "<script language='JavaScript'>";
            echo "document.frm.submit();";
            echo "</script>";
            exit();
        }
        $trainTable = TableRegistry::get('trains');

        $train = $trainTable->find()
            ->contain(['Marques'])
            ->where(
                [
                    'trains.id' => $_POST['train'],
                ]
            )
            ->all();
        $train = $train->first();
        $this->set('train', $train);
    }

    public function ebillingNotif(){
        if($this->request->is('post')){
            $connection = ConnectionManager::get('default');
            $_POST['etat'] = "Payée";
            $results = $connection
                ->execute(
                    "UPDATE ebilling SET paymentsystem = '".$_POST['paymentsystem']."', transactionid = '".$_POST['transactionid']."', billingid = '".$_POST['billingid']."', amount = '".$_POST['amount']."', etat = '".$_POST['etat']."'  WHERE external_reference = '".$_POST['reference']."'"
                );
            if($results){
                http_response_code(200);
                echo http_response_code();
                exit();
            }else{
                http_response_code(401);
                echo http_response_code();
                exit();
            }
        }else{
            http_response_code(402);
            echo http_response_code();
            exit();
        }
    }

    public function arriver(){

        if (empty($_SESSION['panier']['train'])){
            $_SESSION['panier']['prix'] = $_POST['montant'];
            $_SESSION['panier']['train']['lieu_depart'] =  $_POST['lieu_depart'];
            $_SESSION['panier']['train']['lieu_arriver'] =  $_POST['lieu_arriver'];
            $_SESSION['panier']['train']['date_depart'] =  $_POST['date_depart'];
            $_SESSION['panier']['train']['date_arriver'] =  $_POST['date_arriver'];
            $_SESSION['panier']['train']['userEmail'] =  $_POST['email'];
            $_SESSION['panier']['train']['id'] =  $_POST['train'];
            $_SESSION['panier']['count']=1;
            $id=intval($_SESSION['panier']['train']['id']);    
        }else{
            $id=intval($_SESSION['panier']['train']['id']);
        }
        $trainTable = TableRegistry::get('trains');
        $train = $trainTable->find()
            ->contain('Marques')
            ->where(
                [
                    'trains.id' => $id,
                ]
            )
            ->all();
        $train=$train->first();
        $this->set(compact('train'));
        if($this->request->is('post') && isset($_POST['Confirmer'])){
            $userTable = TableRegistry::get('Users');

            $user = $userTable->find()
                ->where(
                    [
                        'Email' => $_POST['email'],
                    ]
                )
                ->all();

            if ($user->first()) {
                $user_edit = $userTable->newEntity();
                $user_edit->FirstName = $_POST['nom'];
                $user_edit->LastName = $_POST['prenom'];
                $user_edit->Email = $_POST['email'];
                $user_edit->Conctactno = $_POST['telephone'];
                $user_edit->BornDate = $_POST['date_naissance'];
                $user_edit->Address = $_POST['adresse'];
                $user_edit->City = $_POST['ville'];
                $user_edit->Country = $_POST['pays'];
                $user_edit->ZipCode = $_POST['poste'];
                $user_edit->Province = $_POST['province'];
                $user_edit->id = $user->first()->id;
                $userTable->save($user_edit);
                $_SESSION['panier']['train']['userEmail'] =  $user_edit->id;
            } else {
                $user = $userTable->newEntity();
                $user->FirstName = $_POST['nom'];
                $user->LastName = $_POST['prenom'];
                $user->Email = $_POST['email'];
                $user->Conctactno = $_POST['telephone'];
                $user->BornDate = $_POST['date_naissance'];
                $user->Address = $_POST['adresse'];
                $user->City = $_POST['ville'];
                $user->Country = $_POST['pays'];
                $user->ZipCode = $_POST['poste'];
                $user->Province = $_POST['province'];
                $userTable->save($user);
                $_SESSION['panier']['train']['userEmail'] =  $user->id;
            }
            $reference = AppController::str_random(6);
            $reservationTable = TableRegistry::get('Reservations');
            $reservation = $reservationTable->newEntity();
            $reservation->Status = 'En Traitement';
            $reservation->reference = $reference;
            $reservation->userEmail = $_SESSION['panier']['train']['userEmail'];
            $reservation->VehicleId = $_SESSION['panier']['train']['id'];
            $reservation->FromDate = $_SESSION['panier']['train']['date_depart'];
            $reservation->ToDate = $_SESSION['panier']['train']['date_arriver'];
            $reservation->FromPlace = $_SESSION['panier']['train']['lieu_depart'];
            $reservation->ToPlace = $_SESSION['panier']['train']['lieu_arriver'];
            $reservation->Price = $_SESSION['panier']['prix'];
            $reservation->Payment = 'Arriver';
            $reservationTable->save($reservation);
            $this->redirect(['controller' => 'Reservations','action' => 'bookingSucces', 'get' => 'Arriver', 'ref'=>$reference]);        
        }
    }

    public function visa(){
 
    }

    public function bookingSucces(){
        $reservationTable = TableRegistry::get('Reservations');
    	$reservation = $reservationTable->find()
        ->where(
            [
                'reference' => $this->request->params['?']['ref'],
            ]
        )
        ->all();
        if($reservation->first()){
            $reservation = $reservation->first();
            if($this->request->params['?']['get'] == 'Arriver'){
                $reservation->Status = 'En attente de paiement';
            }else{
                $reservation->Status = 'Payée';
            }
            $reservation->Payment = $this->request->params['?']['get'];
            $reservationTable->save($reservation);
            $this->set(compact('reservation'));
        }else{
        	 $this->Flash->error('Référence inexistante.');
            $this->redirect(['controller' => 'Transports','action' => 'index', 'reset' => 'true']);
        }
        $id=intval($reservation->VehicleId);
        $trainTable = TableRegistry::get('trains');

        $train = $trainTable->find()
            ->where(
                [
                    'id' => $id,
                ]
            )
            ->all();
        $train=$train->first();
        $nombre = $train->Nombre_reel - 1;
        if ($nombre < 0) {
            $nombre = 0; 
        }
        $train->Nombre_reel = $nombre;
        $trainTable->save($train);

        ///Vider le panier & la session


        $contenu = ReservationsTable::data_reservation($this->request->params['?']['ref']);

        $to =  $contenu['email'];

        $mail = new Email();
        $mail->setFrom('commercial@transports-citadins.com')
            ->setTo(["richard.mebodo@jobs-conseil.com", $to])
            ->setSubject('Réservation chez Les Transports Citadins')
            ->setEmailFormat('html')
            ->setTemplate('reservation')
            ->setViewVars(array(
                'contenu' => $contenu,
            ))
            ->send();

        if ($mail){
            $this->Flash->success('Votre réservation a été enregistré avec succès.');
        }else{
            $this->Flash->error('Votre réservation a bien été enregistré, mais problème d\'envoie de mail.');
        }

        $result_message = '<div class="divBorder" style="min-height: 460px;">

                            <h3> Réservation éffectuée </h3>
                            <br />

                            <h4>Détails de la réservation:</h4>

                            <strong>Libellé : </strong>'.$contenu['brand'].' '.$contenu['title'].'<br />
                            <strong>Référence : </strong>'.$contenu['reference'].'<br />
                            <strong>Status : </strong>'.$contenu['status'].'<br />
                            <strong>Montant : </strong>'.AppController::change_number_format($contenu['montant']) .' Francs CFA <br/>

                            <br />
                            <br />

                            <h4>Reservé par :</h4>

                            <address>
                              <strong>'.$contenu['nom'].' '.$contenu['prenom'].'</strong><br />
                              '.$contenu['telephone'].' - '.$contenu['email'].'<br />
                              '.$contenu['poste'].', '.$contenu['adresse'].' '.$contenu['ville'].'<br />
                              '.$contenu['pays'].'
                            </address>

                            <br>

                          </div>';

        $this->set('result_message', $result_message);
    
        $_SESSION['panier'] = array();
        $_SESSION['panier']['count']=0;
        $_SESSION['panier']['prix']=0;
        $_SESSION['panier']['train']= array();
    }

    public function printed(){
        if(empty($this->request->params['?']['reference'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else{
            $reservationTable = TableRegistry::get('reservations');
            $reservation = $reservationTable->find()
                ->where(
                    [
                        'reference' => $this->request->params['?']['reference'],
                    ]
                )
                ->all();

            if (!$reservation->first()) {
                $this->Flash->error('Cette reservation n\'existe pas.');
                $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            } else {
                $reservation = $reservation->first();
                $contenu = ReservationsTable::data_reserver($reservation->reference);
                $titre = "Réservation N° ".$contenu['id'];
                $this->viewBuilder()->options([
                    'pdfConfig' => [
                        'orientation' => 'portrait',
                        'filename' => 'Billet_'.$reservation->id
                    ]
                ]);
                $this->set('contenu', $contenu);
                $this->set('titre', $titre);
                $CakePdf = new \CakePdf\Pdf\CakePdf();
                $CakePdf->template('printed', 'default');
                $CakePdf->viewVars($this->viewVars);
                // Get the PDF string returned
                $pdf = $CakePdf->output();
                $pdf = $CakePdf->write(WWW_ROOT . 'files' . DS . 'Billet_'.$reservation->id.'.pdf');
                $this->redirect('http://localhost/booking.ga-git/files/Billet_'.$reservation->id.'.pdf');
            }
        }
    }
}
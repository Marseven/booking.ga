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
        $this->Auth->allow(['booking', 'validateBooking', 'bookingSucces', 'arriver', 'printed']);
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
        $tra = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'tra' => $tra,
            'dms' => $dms,
        ));
    }

    public function reservationitem(){
        $this->menu();
        if(empty($this->request->params['?']['reference'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Booking','action' => 'index']);
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
            ->where(
                [
                    'id_categorie' => $train->id_categorie,
                    'trains.id <>' => $train->id,
                    'id_semaine' => $train->id_semaine
                ]
            )
            ->limit(5)
            ->all();

        $this->set('train', $train);
        $this->set('trains_related', $trains_related);

    }

    public function Airtelmoney(){

        if (empty($_SESSION['panier']['train'])){
            $_SESSION['panier']['prix'] = $_POST['montant'];
            $_SESSION['panier']['train']['lieu_depart'] =  $_POST['lieu_depart'];
            $_SESSION['panier']['train']['lieu_arriver'] =  $_POST['lieu_arriver'];
            $_SESSION['panier']['train']['date_depart'] =  $_POST['date_depart'];
            $_SESSION['panier']['train']['classe'] =  $_POST['classe'];
            $_SESSION['panier']['train']['userEmail'] =  $_POST['email'];
            $_SESSION['panier']['train']['id'] =  $_POST['train'];
            $_SESSION['panier']['count']=1;
            $id=intval($_SESSION['panier']['train']['id']);    
        }else{
            $id=intval($_SESSION['panier']['train']['id']);
        }
        $trainTable = TableRegistry::get('trains');
        $train = $trainTable->find()
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
            $reservation->Status = 'Pending';
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

    public function validateBooking(){
        $reservationTable = TableRegistry::get('Reservations');
        if(empty($this->request->params['?']['train'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }else{
            $id = (int)$this->request->params['?']['train'];
        }
        if ($this->request->is('post')) {
            
                $aujourdhui = date('Y-m-d H:m');
                $aujourdhui = new \DateTime($aujourdhui);
                $aujourdhui = $aujourdhui->add(new \DateInterval('PT2H'));
                $date_depart = new \DateTime($_POST['date_depart']);
                
                $intervale = AppController::difference_temps($aujourdhui, $date_depart);
                if ($intervale < 2.00) {
                    $this->Flash->error('La réservation doit être effectué au moins 2 heures avant l\'heure de départ.');
                    $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
                }
                $infos['vid'] = $id;
                if(ReservationsTable::is_aviable($infos)){
                    $date_depart = explode(' ', $_POST['date_depart']);
                    $trainTable = TableRegistry::get('trains');

                    $train = $trainTable->find()
                        ->where(
                            [
                                'trains.id' => $id,
                            ]
                        )
                        ->all();
                    $train = $train->first();
                    $tarif = $tarifTable->find()
                        ->where(
                            [
                                'tarifs.id' => $id,
                            ]
                        )
                        ->all();
                    $_SESSION['panier']['prix'] = $tarif->prix;
                    $_SESSION['panier']['train']['lieu_depart'] =  $_POST['lieu_depart'];
                    $_SESSION['panier']['train']['lieu_arriver'] =  $_POST['lieu_arriver'];
                    $_SESSION['panier']['train']['date_depart'] =  $_POST['date_depart'];
                    $_SESSION['panier']['train']['classe'] =  $_POST['classe'];
                    $_SESSION['panier']['train']['id'] =  $id;
                    $_SESSION['panier']['count']=1;
                    $this->set('train', $train);
                    $this->set('prix_total', $prix_total);
                    $this->set([
                        'date_depart' => $date_depart,
                        'classe' => $classe,
                        'lieu_arriver' => $_POST['lieu_arriver'],
                        'lieu_depart' => $_POST['lieu_depart']
                    ]);
                }else{
                    $this->Flash->error('Il y a plus de place pour cette date, Merci d\'essayer une autre date.');
                    $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
                }
            
        }elseif(isset($_SESSION['panier']['train']) && !empty($_SESSION['panier']['train'])){
            $aujourdhui = date('Y-m-d H:m');

            $aujourdhui = new \DateTime($aujourdhui);
            $date_depart = new \DateTime($_SESSION['panier']['train']['date_depart']);
            

            $infos = array();
            $infos['depart'] = $date_depart;
            $infos['tid'] = $id;
            if(ReservationsTable::is_aviable($infos)){
                $date_depart = explode(' ', $_SESSION['panier']['train']['date_depart']);
                $trainTable = TableRegistry::get('trains');

                $train = $trainTable->find()
                    ->where(
                        [
                            'trains.id' => $id,
                        ]
                    )
                    ->all();
                $train = $train->first();
                $tarif = $tarifTable->find()
                        ->where(
                            [
                                'tarifs.id' => $id,
                            ]
                        )
                        ->all();
                $this->set('train', $train);
                $this->set('prix_total', $tarif->prix);
                $this->set([
                    'date_depart' => $date_depart,
                    'lieu_arriver' => $_SESSION['panier']['train']['lieu_arriver'],
                    'lieu_depart' => $_SESSION['panier']['train']['lieu_depart']
                ]);
            }else{
                $this->Flash->error('Plus de places disponibles, Merci d\'essayer une autre période.');
                $this->redirect(['controller' => 'Reservations','action' => 'booking', 'train' => $id]);
            }

        }else{
            $this->Flash->error('Panier Vide.');
            $this->redirect(['controller' => 'Transports','action' => 'index', 'reset' => 'true']);
        }
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
            $this->redirect(['controller' => 'Booking','action' => 'index', 'reset' => 'true']);
        }
        $id=intval($reservation->TrainId);
        $trainTable = TableRegistry::get('trains');

        $train = $trainTable->find()
            ->where(
                [
                    'id' => $id,
                ]
            )
            ->all();
        $train=$train->first();
        $nombre = $train->NombrePlace - 1;
        if ($nombre < 0) {
            $nombre = 0; 
        }
        $train->NombrePlace = $nombre;
        $trainTable->save($train);

        ///Vider le panier & la session


        $contenu = ReservationsTable::data_reservation($this->request->params['?']['ref']);

        $to =  $contenu['email'];

        $mail = new Email();
        $mail->setFrom('commercial@setrag.com')
            ->setTo(["richard.mebodo@jobs-conseil.com", $to])
            ->setSubject('Réservation chez Setrag')
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

                            <strong>Libellé : </strong>'.$contenu['classe'].' '.$contenu['title'].'<br />
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
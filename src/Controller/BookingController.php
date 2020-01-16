<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\DemandeForm;
use App\Form\ReservationForm;
use App\Model\Table\MarquesTable;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use App\Form\SearchForm;
use ReCaptcha;

class BookingController extends AppController
{

    public $components = array('Paginator');
    public $paginate = [
        'limit' => 5,
        'order' => ['trains.RegDate' => 'DESC'],
        'paramType' => 'queryString'
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index', 'searchResult', 'trainItem', 'demandeSpeciale', 'reservationSpeciale', 'trainList']);
        $user = $this->Auth->user(); 
        if($user){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
        }
        if (!isset($_SESSION['panier']) || isset($this->request->params['?']['reset'])){
            $_SESSION['panier'] = array();
            $_SESSION['panier']['count']=0;
            $_SESSION['panier']['prix']=0;
            $_SESSION['panier']['train']=array();
        }
        $this->loadComponent('Paginator');
        $this->loadComponent('Captcha.Captcha');

    }

    function menu(){
        $acc = 'active';
        $tra = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'veh' => $tra,
            'dms' => $dms,
        ));
    }

    public function index(){
        $this->menu();
        $trainTable = TableRegistry::get('trains');
        $temoignageTable = TableRegistry::get('temoignages');

        $trains = $trainTable->find()->all();
        $temoignages = $temoignageTable->find()->contain(['Users'])->where(
            [
                'status' => 1,
            ]
        )->limit(2)->all();

        $search = new SearchForm();

        $this->set([
            'temoignages' => $temoignages,
            'trains' => $trains,
            'search' => $search
        ]);
    }

    public function searchResult(){
        $this->menu();
        $trainTable = TableRegistry::get('trains');
        $new_trains = $trainTable->find()
            ->orderDesc('RegDate')
            ->limit(4)
            ->all();
        $this->set([
            'new_trains' => $new_trains,
        ]);
        if (isset($this->request->getData()['search']) && $this->request->getData()['search'] == 'Rechercher') {
            $infos = AppController::date_verified($this->request->getData()['date_depart'], $this->request->getData()['date_arriver']);
             if($infos == false){
                 $this->Flash->error('Mauvaises Dates.');
                 $this->redirect(['controller' => 'Transports','action' => 'index']);
             }else{
                 $aujourdhui = date('Y-m-d H:m');
                 $aujourdhui = new \DateTime($aujourdhui);
                 $aujourdhui = $aujourdhui->add(new \DateInterval('PT2H'));
                 $date_depart = new \DateTime($this->request->getData()['date_depart']);

                 $intervale = AppController::difference_temps($aujourdhui, $date_depart);
                 if ($intervale < 2.00) {
                     $this->Flash->error('La réservation doit être effectué au moins 2 heures avant l\'heure de départ.');
                     $this->redirect(['controller' => 'Transports','action' => 'index']);
                 }
             }
        }
        if (isset($_POST['search']) && $_POST['search'] == 'autre') {
            $classe = $_POST['brand'];
            $type = $_POST['type'];
            $trains_search = $trainTable->find()
                ->where(
                    [
                        'Classe' => $classe,
                        'Type' => $type,
                    ]
                )
                ->all();
            $trains_related = $trainTable->find()
                ->where(
                    [
                        'Type' => $type,
                    ]
                )
                ->limit(5)
                ->all();
            $this->set([
                'trains_search_a' => $trains_search,
            ]);
            $this->set('trains_related', $trains_related);
        }elseif(isset($this->request->getData()['search']) && $this->request->getData()['search'] == 'Rechercher') {
            $classe=$this->request->getData()['classe'];
            $type=$this->request->getData()['type'];
            $trains_search = $trainTable->find()
                ->where(
                    [
                        'Type' => $type,
                        'Classe' => $classe,
                    ]
                )
                ->all();
            if($trains_search->count() == 0){

            }else{
                $data = [
                    'lieu_depart' => $this->request->getData()['lieu_depart'],
                    'lieu_arriver' => $this->request->getData()['lieu_arriver'],
                    'date_depart' => $this->request->getData()['date_depart'],
                    'date_arriver' => $this->request->getData()['date_arriver'],
                ];
            }

            $trains_related = $trainTable->find()
                ->where(
                    [
                        'Type' => $type,
                    ]
                )
                ->limit(5)
                ->all();
            $this->set([
                'trains_search_A' => $trains_search,
                'data' => $data
            ]);
            $this->set('trains_related', $trains_related);
        }else{
            $this->Flash->error('Mauvaises informations.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }
    }

    public function trainList(){
        $this->menu();
        $trainTable = TableRegistry::get('trains');
        
        $trains = $this->paginate($trainTable->find());

        $new_trains = $trainTable->find()
            ->orderDesc('RegDate')
            ->limit(4)
            ->all();

        $this->set([
            'trains' => $trains,
            'new_trains' => $new_trains
        ]);
    }

    public function trainItem(){
        $this->menu();
        if(empty($this->request->params['?']['train'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
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
            $this->redirect(['controller' => 'Transports','action' => 'trainList']);
        }else{
            $train = $train->first();
        }

        $trains_related = $trainTable->find()
            ->where(
                [
                    'Type' => $train->Type,
                    'trains.id <>' => $train->id,
                ]
            )
            ->limit(5)
            ->all();
        if($this->request->is('post'))
        {
            $data = [
                'lieu_depart' => $this->request->getData()['lieu_depart'], 
                'lieu_arriver' => $this->request->getData()['lieu_arriver'],
                'date_depart' => $this->request->getData()['date_depart'],
                'date_arriver' => $this->request->getData()['date_arriver'],
            ];
            $this->set('data', $data);
        }
        $this->set('train', $train);
        $this->set('trains_related', $trains_related);
    }

    public function demandeSpeciale(){
        $demandeSpeciale = new DemandeForm();
        if($this->request->is('post'))
        {
            if(isset($_POST['g-recaptcha-response'])) {
                $ip = getenv('REMOTE_ADDR');
                $gRecaptchaResponse = $this->request->data['g-recaptcha-response'];

                $captcha = $this->Captcha->check($ip,$gRecaptchaResponse);

                if($captcha->errorCodes == null) {
                    // Success
                    if ($demandeSpeciale->execute($this->request->getData())) {
                        $this->Flash->success('Merci, Nous reviendrons vers vous rapidement.');
                    } else {
                        $this->Flash->error('Il y a eu un problème lors de la soumission du formulaire.');
                    }
                } else {
                    // Fail! Maybe a bot?
                    $error = $captcha->errorCodes;
                    $msg = '';
                    foreach ($error['error-codes'] as $k) {
                        $msg .= $k;
                    }
                    $this->Flash->error($msg);
                }
            } else {
                $error = "Captcha non rempli";
                $this->Flash->error($error);
            }

        }
        $this->set('demandeSpeciale', $demandeSpeciale);
    }

    public function reservationSpeciale(){
        $trainTable = TableRegistry::get('trains');
        $trains = array();
        $trn = $trainTable->find();
        foreach($trn as $t){
            $trains[$v->Title] = $t->Title;
        }
        $reservationSpeciale = new ReservationForm();
        if ($this->request->is('post')) {
            if(isset($_POST['g-recaptcha-response'])) {
                $ip = getenv('REMOTE_ADDR');
                $gRecaptchaResponse = $this->request->data['g-recaptcha-response'];

                $captcha = $this->Captcha->check($ip,$gRecaptchaResponse);

                if($captcha->errorCodes == null) {
                    // Success
                    if ($reservationSpeciale->execute($this->request->getData())) {
                        $this->Flash->success('Merci, Nous reviendrons vers vous rapidement.');
                    } else {
                        $this->Flash->error('Il y a eu un problème lors de la soumission du formulaire.');
                    }
                } else {
                    // Fail! Maybe a bot?
                    $error = $captcha->errorCodes;
                    $msg = '';
                    foreach ($error['error-codes'] as $k) {
                        $msg .= $k;
                    }
                    $this->Flash->error($msg);
                }
            } else {
                $error = "Captcha non rempli";
                $this->Flash->error($error);
            }
        }
        $this->set([
            'reservationSpeciale' => $reservationSpeciale,
            'trains' => $trains
            ]);
    }
}
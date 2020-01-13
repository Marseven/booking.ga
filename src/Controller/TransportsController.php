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

class TransportsController extends AppController
{

    public $components = array('Paginator');
    public $paginate = [
        'limit' => 5,
        'order' => ['Vehicules.RegDate' => 'DESC'],
        'paramType' => 'queryString'
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index', 'searchResult', 'vehiculeItem', 'demandeSpeciale', 'reservationSpeciale', 'vehiculeList']);
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
            $_SESSION['panier']['voiture']=array();
        }
        $this->loadComponent('Paginator');
        $this->loadComponent('Captcha.Captcha');

        $marqueTable = TableRegistry::get('marques');
        $marques = $marqueTable->find()->all();
        $this->set('marques', $marques);
    }

    function menu(){
        $acc = 'active';
        $veh = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'veh' => $veh,
            'dms' => $dms,
        ));
    }

    public function index(){
        $this->menu();
        $vehiculeTable = TableRegistry::get('vehicules');
        $temoignageTable = TableRegistry::get('temoignages');

        $vehicules = $vehiculeTable->find()->contain(['Marques'])->all();
        $temoignages = $temoignageTable->find()->contain(['Users'])->where(
            [
                'status' => 1,
            ]
        )->limit(2)->all();

        $search = new SearchForm();

        $this->set([
            'temoignages' => $temoignages,
            'vehicules' => $vehicules,
            'search' => $search
        ]);
    }

    public function searchResult(){
        $this->menu();
        //debug($this->request);die;
        $vehiculeTable = TableRegistry::get('vehicules');
        $marqueTable = TableRegistry::get('marques');
        $new_vehicules = $vehiculeTable->find()
            ->contain(['Marques'])
            ->orderDesc('RegDate')
            ->limit(4)
            ->all();
        $marques = $marqueTable->find()->all();
        $this->set([
            'new_vehicules' => $new_vehicules,
            'marques' => $marques
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
            $brand = $_POST['brand'];
            $type = $_POST['type'];
            $vehicules_search = $vehiculeTable->find()
                ->contain(['Marques'])
                ->where(
                    [
                        'VehiclesBrand' => $brand,
                        'Type' => $type,
                    ]
                )
                ->all();
            $vehicules_related = $vehiculeTable->find()
                ->contain(['Marques'])
                ->where(
                    [
                        'Type' => $type,
                    ]
                )
                ->limit(5)
                ->all();
            $this->set([
                'vehicules_search_a' => $vehicules_search,
            ]);
            $this->set('vehicules_related', $vehicules_related);
        }elseif(isset($this->request->getData()['search']) && $this->request->getData()['search'] == 'Rechercher') {
            $brand=$this->request->getData()['marque'];
            $type=$this->request->getData()['type'];
            $this->request->getData()['Prix'] = explode(',', $this->request->getData()['Prix']);
            $price1=(int)$this->request->getData()['Prix'][0];
            $price2=(int)$this->request->getData()['Prix'][1];
            $vehicules_search = $vehiculeTable->find()
                ->contain(['Marques'])
                ->where(
                    [
                        'VehiclesBrand' => $brand,
                        'Type' => $type,
                        'PricePerDay >=' => $price1.'and PricePerDay <='.$price2,
                    ]
                )
                ->all();
            if($vehicules_search->count() == 0){

            }else{
                $data = [
                    'lieu_depart' => $this->request->getData()['lieu_depart'],
                    'lieu_arriver' => $this->request->getData()['lieu_arriver'],
                    'date_depart' => $this->request->getData()['date_depart'],
                    'date_arriver' => $this->request->getData()['date_arriver'],
                ];
            }

            $vehicules_related = $vehiculeTable->find()
                ->contain(['Marques'])
                ->where(
                    [
                        'Type' => $type,
                    ]
                )
                ->limit(5)
                ->all();
            $this->set([
                'vehicules_search_A' => $vehicules_search,
                'data' => $data
            ]);
            $this->set('vehicules_related', $vehicules_related);
        }else{
            $this->Flash->error('Mauvaises informations.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }
    }

    public function vehiculeList(){
        $this->menu();
        $vehiculeTable = TableRegistry::get('vehicules');
        $marqueTable = TableRegistry::get('marques');

        $vehicules = $this->paginate($vehiculeTable->find()->contain(['Marques']));

        $new_vehicules = $vehiculeTable->find()
            ->contain(['Marques'])
            ->orderDesc('RegDate')
            ->limit(4)
            ->all();

        $marques = $marqueTable->find()->all();

        $this->set([
            'vehicules' => $vehicules,
            'new_vehicules' => $new_vehicules,
            'marques' => $marques
        ]);
    }

    public function vehiculeItem(){
        $this->menu();
        if(empty($this->request->params['?']['vehicule'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Transports','action' => 'index']);
        }else{
            $id = (int)$this->request->params['?']['vehicule'];
        }

        $vehiculeTable = TableRegistry::get('vehicules');

        $vehicule = $vehiculeTable->find()
            ->contain(['Marques'])
            ->where(
                [
                    'vehicules.id' => $id,
                ]
            )
            ->all();

        if (!$vehicule->first()) {
            $this->Flash->error('Ce vehicule n\'existe pas.');
            $this->redirect(['controller' => 'Transports','action' => 'vehiculeList']);
        }else{
            $vehicule = $vehicule->first();
        }

        $vehicules_related = $vehiculeTable->find()
            ->contain(['Marques'])
            ->where(
                [
                    'Type' => $vehicule->Type,
                    'vehicules.id <>' => $vehicule->id,
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
        $this->set('vehicule', $vehicule);
        $this->set('vehicules_related', $vehicules_related);
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
        $vehiculeTable = TableRegistry::get('vehicules');
        $vehicules = array();
        $vhc = $vehiculeTable->find()->contain(['Marques']);
        foreach($vhc as $v){
            $vehicules[$v->marque->BrandName.', '.$v->VehiclesTitle] = $v->marque->BrandName.', '.$v->VehiclesTitle;
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
            'vehicules' => $vehicules
            ]);
    }
}
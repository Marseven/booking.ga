<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Table\MarquesTable;
use App\Model\Table\ReservationsTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;
use Cake\Auth\DefaultPasswordHasher;

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

class UsersController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'confirm', 'resetPassword', 'signup', 'logout']);
        $user = $this->Auth->user();
        if($user){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
        }
        $marques = MarquesTable::marque();
        $this->set(compact('marques'));

    }



    function menu(){
        $acc = '';
        $cat = '';
        $usr = 'active';

        $this->set(array(
            'acc' => $acc,
            'cat' => $cat,
            'usr' => $usr,
        ));
    }
	
	public function index(){
        $reservationTable = TableRegistry::get('Reservations');
        $reservations = $reservationTable->find()->all();
        $this->set('reservations', $reservations);
        $trains = $trainTable->find()->all();
        $this->set('trains', $trains);
        $temoignageTable = TableRegistry::get('Temoignages');
        $temoignages = $temoignageTable->find()->all();
        $this->set('temoignages', $temoignages);
        $usersTable = TableRegistry::get('Users');
        $users = $usersTable->find()
            ->where(
                [
                    'role' => 'membre',
                ]
            )
            ->all();
        $this->set('users', $users);
        $this->render('index', 'default-admin');
	}

	function login(){
        $this->menu();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Content de vous revoir '.$this->Auth->user('LastName').' '.$this->Auth->user('FirstName'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre email ou mot de passe est incorrect.');
        }
        return $this->render('login', 'login-admin');
    }


    function logout(){
        $date = date('Y-m-d H:m:s');
        $usersTable = TableRegistry::get('Users');
        $user = $this->Auth->user();
        if(is_array($user)){
            $user = $usersTable->get($user['id']);
        }
        return $this->redirect(['action' => 'login']);
    }

    function signup(){
        $this->menu();
        if($this->request->is('post')){
            if(empty($this->request->getData()['Password']) || $this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                return $this->render('login');
            }
            $usersTable = TableRegistry::get('Users');
            $exist_email = $usersTable->find()
                ->where(
                    [
                        'Email' => $this->request->getData()['Email'],
                    ]
                )
                ->limit(1)
                ->all();
            if(!$exist_email->isEmpty()){
                $this->Flash->error('Cette email existe déjà.');
                return $this->render('login');
            }
            $user = $usersTable->newEntity($this->request->getData());
			$user->picture = '#';
           if ($usersTable->save($user)) {
                $link = array(
                    'controller' => 'users',
                    'action' => 'confirm',
                    'token' => $user->id.'-'.md5($user->Password)
                );
                $user->confirmed_token = md5($user->Password);
                $usersTable->save($user);
                $mail = new Email();
                $mail->setFrom('contact@setrag.com')
                     ->setTo($user->Email)
                     ->setSubject('Confirmation d\'enregistrement ')
                     ->setEmailFormat('html')
                     ->setTemplate('confirmation')
                     ->setViewVars(array(
                        'last_name' => $user->LastName.' '.$user->FirstName,
                        'link' => $link
                     ))
                     ->send();
                $this->Flash->set('Vous avez été enregistrer avec succès, un email de confirmation vous a été envoyé.', ['element' => 'success']);
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'signup',
                ));
           }else{
                $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'danger']);
           }
        }
        $this->render('signup', 'default-admin');

    }

    function edit(){
        $this->menu();
        if(empty($this->request->params['?']['user'])){
            $this->Flash->error('Information manquante.');
            return $this->redirect(['action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['user'];
        }
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->get($id);
        if (!$user) {
            $this->Flash->error('Ce profil n\'exite pas');
            return $this->redirect(['action' => 'logout']);
        }
        if ($this->request->is(array('post','put'))) {
            if(empty($this->request->getData()['Password']) || $this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
            }else{
                $user = $usersTable->newEntity($this->request->getData());
                if ($usersTable->save($user)) {
					$user->id_key = $this->Auth->user('id_key');
                    $this->Auth->setUser($user);
                    $this->Flash->set('Vos informations ont été mis à jour avec succès.', ['element' => 'success']);
                    return $this->redirect(['action' => 'index']);
                }else{
                    $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
                }
            }
        }
        $this->set('user_edit', $user);
        $this->render('edit', 'default-admin');
    }

    function confirm(){
        $this->menu();
        $token = $_GET['token'];
        $token = explode('-', $token);
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->find()
                            ->where(
                                [
                                    'id' => $token[0],
                                    'confirmed_token' => $token[1],
                                ]
                            )
                            ->limit(1)
                            ->all();
        if(!empty($user->first())){
            $user = $user->first();
            $user->confirmed_at = date('Y-m-d H:m:s');
            $user->confirmed_token = NULL;
            $usersTable->save($user);
            $this->Flash->set('Bienvenue '.$user->last_name.' '.$user->first_name, ['element' => 'success']);
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }else{
            $this->Flash->set('Ce lien n\'est plus valide.', ['element' => 'error']);
            return $this->redirect(array(
                'controller' => 'users',
                'action' => 'login',
            ));
        }
    }

    function resetPassword(){
        $this->menu();
        $usersTable = TableRegistry::get('Users');
        if($this->request->is('post')){
            $user = $usersTable->find()
                ->where([
                    'Email' => $this->request->getData()['Email'],
                ])
                ->limit(1)
                ->all();
            $user = $user->first();
            $password = (new DefaultPasswordHasher)->check($this->request->getData()['Old_Password'], $user->Password);
            if($password){
                if($this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                    $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                    return $this->render('reset_password','default-admin');
                }
                $user->Password = $this->request->getData()['Password'];
                $user->reset_at = date('Y-m-d H:m:s');
                $user->reset_token = NULL;
                $usersTable->save($user);
                $this->Auth->setUser($user);
                $this->Flash->success('Mot de passe réinitialisé avec succès.');
                return $this->render('reset_password','default-admin');
            }else{
                $this->Flash->set('Ancien Mot de passe incorrect !', ['element' => 'error']);
                return $this->render('reset_password','default-admin');
            }
        }
        $this->render('reset_password', 'default-admin');
    }

    public function listClient(){
        $this->menu();
        $usersTable = TableRegistry::get('Users');
        $users = $usersTable->find()
            ->where(
                [
                    'role' => 'membre',
                ]
            )
            ->all();
        $this->set('users', $users);
        $this->render('list_member', 'default-admin');
    }

    public function delete(){
        $this->menu();
        if(empty($this->request->params['?']['user'])){
            $this->Flash->error('Information manquante.');
            return $this->redirect(['action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['user'];
        }
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->get($id);
        if (!$user) {
            $this->Flash->error('Ce profil n\'exite pas');
            return $this->redirect(['action' => 'logout']);
        }else{
            if($user->role == 'membre'){
                $usersTable->delete($user);
                $this->Flash->set('Le membre a été supprimé avec succès.', ['element' => 'success']);
                $this->redirect(['controller' => 'Users','action' => 'index']);
            }else{
                $this->Flash->set('L\'utilisateur que vous essayer de supprimer est un administrateur ', ['element' => 'error']);
                $this->redirect(['controller' => 'Users','action' => 'index']);
            }
        }
    }

    public function reservations(){
        $this->menu();
        $reservationTable = TableRegistry::get('Reservations');
        $reservations = $reservationTable->find()->contain(['Users', 'trains' => function ($q) {
														        return $q->contain('Marques');
														    }])->all();
        $this->set('reservations', $reservations);
        $this->render('reservations', 'default-admin');
    }

    public function temoignages(){
        $this->menu();
        $temoignageTable = TableRegistry::get('Temoignages');
        $temoignages = $temoignageTable->find()->contain('Users')->all();
        $this->set('temoignages', $temoignages);
        $this->render('temoignages', 'default-admin');
    }

    public function newsletter(){
        $this->menu();
        $newsletterTable = TableRegistry::get('Newsletters');
        $newsletters = $newsletterTable->find();
        $this->set('newsletters', $newsletters);
        $this->render('newsletter', 'default-admin');
    }

    public function printed(){
        if(empty($this->request->params['?']['reference'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else {

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
                        'filename' => 'Facture_LTC_'.$reservation->id
                    ]
                ]);
                $this->set('contenu', $contenu);
                $this->set('titre', $titre);
                $CakePdf = new \CakePdf\Pdf\CakePdf();
                $CakePdf->template('printed', 'default');
                $CakePdf->viewVars($this->viewVars);
                // Get the PDF string returned
                $pdf = $CakePdf->output();
                $pdf = $CakePdf->write(WWW_ROOT . 'files' . DS . 'Billet'.$reservation->id.'.pdf');
                $this->redirect('http://localhost/booking.ga-git/files/Billet'.$reservation->id.'.pdf');
            }
        }
    }

    public function realiser(){
        if(empty($this->request->params['?']['reference'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else {

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
                if ($reservation->Realiser == 0) {
                    # code...
                    $trainTable = TableRegistry::get('trains');

                    $vehicule = $trainTable->find()
                        ->where(
                            [
                                'id' => $reservation->VehicleId,
                            ]
                        )
                        ->all();
                    $vehicule=$vehicule->first();

                    $vehicule->Nombre_reel = $vehicule->Nombre_reel + 1;

                    if ($vehicule->Nombre_reel > $vehicule->Nombre) {
                        # code...
                        $vehicule->Nombre_reel = $vehicule->Nombre;
                    }

                    $trainTable->save($vehicule);

                    $reservation->Realiser = 1;
                    if($reservation->Payment == "Arriver"){
                        $reservation->Status = 'Payé'; 
                    }

                    $reservationTable->save($reservation);

                    $this->Flash->success('Prestation de service réalisée avec succès.');
                    $this->redirect(['prefix' => 'admin', 'controller' => 'Users','action' => 'reservations']);
                } else {
                    $this->Flash->success('Prestation déjà réalisée.');
                    $this->redirect(['prefix' => 'admin', 'controller' => 'Users','action' => 'reservations']);
                }
            }
        }
    }

    public function moderer(){
        if(!empty($this->request->params['?']['iid']))
        {
            $iid=intval($this->request->params['?']['iid']);
            $temoignageTable = TableRegistry::get('temoignages');
            $temoignage = $temoignageTable->get($iid);
            $temoignage->status = 0;
            $temoignageTable->save($temoignage);
            $this->Flash->success('Témoignage désactivé avec succès');
            $this->redirect(['prefix' => 'admin', 'controller' => 'Users','action' => 'temoignages']);
        }

        if(!empty($this->request->params['?']['aid']))
        {
            $aid=intval($this->request->params['?']['aid']);
            $temoignageTable = TableRegistry::get('temoignages');
            $temoignage = $temoignageTable->get($aid);
            $temoignage->status = 1;
            $temoignageTable->save($temoignage);
            $this->Flash->success('Témoignage activé avec succès');
            $this->redirect(['prefix' => 'admin', 'controller' => 'Users','action' => 'temoignages']);
        }
    }

    static function export(){
        header('Content-Type: text/csv;');
        header('Content-Disposition: attachment; filename="Liste_Client_Setrag.csv"');
        $i = 0;
        $usersTable = TableRegistry::get('Users');
        $users = $usersTable->find()
            ->where(
                [
                    'role' => 'membre',
                ]
            )
            ->all();
        $data=array();
        foreach ($users as $user) {
            $date = new \DateTime($user->BornDate);
            $date = $date->format('d-m-Y');
            $user->BornDate = $date;
            $date_reg = new \DateTime($user->RegDate);
            $date_reg = $date_reg->format('d-m-Y H:i');
            $user->RegDate = $date_reg;
            $date_upd = new \DateTime($user->UpdationDate);
            $date_upd = $date_upd->format('d-m-Y H:i');
            $user->UpdationDate = $date_upd;
            $data[$i] = $user;
            $i++;
        }
        $i=0;
        foreach ($data as $v) {
            $v = $v->toArray();
            if ($i==0) {
                echo '"'.implode('";"',array_keys($v)).'"'."\n";
            }
            echo '"'.implode('";"',$v).'"'."\n";
            $i++;
        }
        die;
    }
}

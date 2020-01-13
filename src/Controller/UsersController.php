<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

class UsersController extends AppController {

    public $components = array('Paginator');
    public $paginate = [
        'limit' => 12,
        'order' => ['Reservations.PostingDate' => 'DESC'],
        'paramType' => 'queryString'
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'remember', 'confirm', 'resetPassword', 'signup', 'logout']);
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
            $_SESSION['panier']['voiture']= array();
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
	
	public function index(){
        $this->menu();
        $user = $this->Auth->user();
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->newEntity($user);
        $this->set('user_edit', $user);
    }

	function login(){
        $this->menu();
        //debug($this->request);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //debug($user);die;
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Content de vous revoir '.$this->Auth->user('LastName').' '.$this->Auth->user('FirstName'));
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Votre email ou mot de passe est incorrect.');
        }
    }

    function logout(){
        $user = $this->Auth->user();
        $this->Flash->set('À Bientôt '.$user['FirstName'].' '.$user['LastName'], ['element' => 'default']);
        return $this->redirect($this->Auth->logout());
    }

    function signup(){
        $this->menu();
        $usersTable = TableRegistry::get('Users');
        $user = $usersTable->newEntity();
        $this->set('new_user', $user);
        if($this->request->is('post')){
            if(empty($this->request->getData()['Password']) || $this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                return $this->render('signup');
            }
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
                return $this->render('signup');
            }
            $user = $usersTable->newEntity($this->request->getData());
           if ($usersTable->save($user)) {
                $link = $user->id.'-'.md5($user->Password);
                $user->confirmed_token = md5($user->password);
                $usersTable->save($user);
                $mail = new Email();
                $mail->setFrom('contact@transports-citadins.com')
                     ->setTo($user->Email)
                     ->setSubject('Confirmation d\'enregistrement')
                     ->setEmailFormat('html')
                     ->setTemplate('confirmation')
                     ->setViewVars([
                        'last_name' => $user->LastName.' '.$user->FirstName,
                        'link' => $link
                     ])
                     ->send();
                     
                $this->Flash->set('Vous avez été enregistrer avec succès, un email de confirmation vous a été envoyé.', ['element' => 'success']);
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'signup',
                ));
           }else{
                $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
           }
        }

    }

    function edit($id = null){
        $this->menu();
        $usersTable = TableRegistry::get('Users');
        if(!empty($this->request->params['?']['user'])){
            $id = (int)$this->request->params['?']['user'];
            $user_edit = $usersTable->get($id);
            if (!$user_edit) {
                $this->Flash->error('Ce profil n\'exite pas');
                $this->redirect(['action' => 'logout']);
            }
            $this->set('user_edit', $user_edit);
        }
        if ($this->request->is(array('post','put'))) {
            if(empty($this->request->getData()['password']) || $this->request->getData()['password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
            }else{
                $user = $usersTable->newEntity($this->request->getData());
                if($id != null){
                    $user->id = $id;
                }else{
                    $user->id = $user_edit->id;
                }
                if ($usersTable->save($user)) {
                    $user = $usersTable->get($id);
                    $this->Auth->setUser($user->toArray());
                    $this->Flash->success('Votre profil a été mis à jour avec succès !');
                    return $this->redirect($this->Auth->redirectUrl());
                }else{
                    $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
                }
            }
        }
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
            $this->Flash->set('Bienvenue dans notre communauté,  '.$user->last_name.' '.$user->first_name, ['element' => 'success']);
            $this->Auth->setUser($user->toArray());
            return $this->redirect($this->Auth->redirectUrl());
        }else{
            $this->Flash->set('Ce lien n\'est plus valide.', ['element' => 'error']);
            return $this->redirect(array(
                'controller' => 'users',
                'action' => 'login',
            ));
        }
    }

    function remember(){
        $this->menu();
        if($this->request->is('post')){
            $usersTable = TableRegistry::get('Users');
            $data = $this->request->getData();
            $user = $usersTable->find()
                ->where([
                    'Email' => $data['Email'],
                ])
                ->limit(1)
                ->all();
            if(empty($user->first())){
                $this->Flash->error('Aucun Profil ne correspond à cette email.');
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                ));
            }else{
                $user = $user->first();
				$link =  $user->id.'-'.md5($user->password);
				$user->reset_token = md5($user->password);
                $usersTable->save($user);
                $mail = new Email();
                $mail->setFrom('contact@trasports-citadins.com')
                    ->setTo($user->Email)
                    ->setSubject('Mot de Passe Oublié')
                    ->setEmailFormat('html')
                    ->setTemplate('forget_password')
                    ->setViewVars(array(
                        'last_name' => $user->LastName.' '.$user->FirstName,
                        'link' => $link
                    ))
                    ->send();
                $this->Flash->success('Un email a été envoyer à votre boîte mail pour réinitialiser votre mot de passe.');
                $this->redirect(array('action' => 'login'));
            }
        }
    }

    function resetPassword(){
        $this->menu();
        $usersTable = TableRegistry::get('Users');

        if($this->request->is('post')){
            if(empty($this->request->getData()['Password']) || $this->request->getData()['Password'] != $this->request->getData()['Password_verify']){
                $this->Flash->set('Mots de passe différents !', ['element' => 'error']);
                return $this->render('reset_password');
            }
            $user = $usersTable->find()
                ->where([
                    'Email' => $this->request->getData()['Email'],
                ])
                ->limit(1)
                ->all();
            $user = $user->first();
            $user->reset_at = date('Y-m-d H:m:s');
            $user->reset_token = NULL;
            $usersTable->save($user);
            $this->Auth->setUser($user->toArray());
            $this->Flash->success('Mot de passe réinitialisé avec succès.');
            $this->redirect(array('action' => 'resetPassword'));
        }

        if(!empty($_GET['token'])){
            $token = $_GET['token'];
            $token = explode('-', $token);
            $user = $usersTable->find()
                ->where([
                    'id' => $token[0],
                    'reset_token' =>$token[1],
                ])
                ->limit(1)
                ->all();
            if(empty($user->first())){
                $this->Flash->error('Ce lien n\'est pas valide.');
                return $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                )); 
            }else{
                $email = $user->first()->Email;
                $this->set('email', $email);
            }
        }elseif (empty($this->Auth->user())) {
            $this->redirect(array('action' => 'login'));
        }

    
    }

    public function reservationList(){
        $this->menu();
        $reservationTable = TableRegistry::get('reservations');
        $user = $this->Auth->user();
        if($user){
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->newEntity($user);
        }
        $reservations =$reservationTable->find()->contain(['Vehicules' => function ($q) {
                                                                return $q->contain('Marques');
                                                            }])->where(
            [
                'userEmail' => $user->id,
            ]
        )->all();
        $this->set(compact('reservations'));
    }

    public function check_availability(){
        if(!empty($_POST["email"])) {
            $email= $_POST["email"];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
                echo "Erreur : Email invalide.";
            }else {
                $usersTable = TableRegistry::get('Users');
                $exist_email = $usersTable->find()
                    ->where(
                        [
                            'email' => $_POST['email'],
                        ]
                    )
                    ->limit(1)
                    ->all();
                if($exist_email->first())
                {
                    echo "<span style='color:red'> Cet email existe déjà .</span>";
                    echo "<script>$('#submit').prop('disabled',true);</script>";
                } else{
                    
                    echo "<span style='color:green'> Email disponible .</span>";
                    echo "<script>$('#submit').prop('disabled',false);</script>";
                }
            }
        }
    }

}

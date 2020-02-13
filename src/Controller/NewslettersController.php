<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class NewslettersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index', 'add']);
        $user = $this->Auth->user();
        if(isset($user)){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
        }
    }

    public function index()
    {

    }

    public function add(){
        if ($this->request->is('post')) {
            $newslettersTable = TableRegistry::get('Newsletters');
            $email = $newslettersTable->newEntity($this->request->getData());
            if($newslettersTable->save($email)){
                $this->Flash->success('Bienvennue Dans La Newsletter De Setrag !');
                $this->redirect(['controller' => 'Annonces','action' => 'index']);
            }else{
                $this->Flash->error('Désolé vous n\'avez pas pus être enregistrer dans la newsletter !');
                $this->redirect(['controller' => 'Annonces','action' => 'index']);
            }
        }
    }

    public function delete(){
        if(empty($this->request->params['?']['email'])){
            $this->Flash->error('Information manquante.');
            $this->redirect(['controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['email'];
        }
        $newslettersTable = TableRegistry::get('Newsletters');
        $email = $newslettersTable->find()
            ->where(
                [
                    'id' => $id,
                ]
            )
            ->all();

        if (!$email->first()) {
            $this->Flash->error('Cette email n\'existe pas.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        }else{
            $newslettersTable->delete($email->first());
            $this->Flash->set('cette email a été supprimé avec succès.', ['element' => 'success']);
            $this->redirect(['controller' => 'Users','action' => 'index']);
        }
    }
}
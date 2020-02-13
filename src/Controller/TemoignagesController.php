<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class TemoignagesController extends AppController
{

    public $components = array('Paginator');
    public $paginate = [
        'limit' => 12,
        'order' => ['Temoignages.PostingDate' => 'DESC'],
        'paramType' => 'queryString'
    ];

    public function initialize()
    {
        parent::initialize();
        $user = $this->Auth->user();
        if($user){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
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

    public function index(){
        $this->menu();
        $temoignageTable = TableRegistry::get('temoignages');
        $user = $this->Auth->user();
        if($user){
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->newEntity($user);
        }
        
        $temoignages = $temoignageTable->find()->where(
            [
                'UserEmail' => $user->id,
            ]
        )->all();
        $this->set(compact('temoignages'));
        $this->render('list');
    }

    public function add(){
        $this->menu();

        if ($this->request->is('post')) {
            $temoignageTable = TableRegistry::get('temoignages');
            $temoignage = $temoignageTable->newEntity($this->request->getData());
            if($temoignage->UserEmail === null){$temoignage->UserEmail = $this->request->getData()['UserEmail'];}
            $this->Flash->success('Témoignage envoyé avec succès, en attente de validation...');
            $temoignageTable->save($temoignage);
        };
    }

    public function edit()
    {
        $this->menu();

        if (empty($this->request->params['?']['temoignage'])) {
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        } else {
            $id = (int)$this->request->params['?']['temoignage'];
            $temoignageTable = TableRegistry::get('temoignages');
            $temoignage = $temoignageTable->get($id);
            if (!$temoignage) {
                $this->Flash->error('ce temoignage n\'existe pas.');
                $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    $temoignage = $temoignageTable->newEntity($this->request->getData());
                    if($temoignage->UserEmail === null){$temoignage->UserEmail = $this->request->getData()['UserEmail'];}
                    if ($temoignageTable->save($temoignage)) {
                        $this->Flash->set('Votre temoignage a été mise à jour avec succès.', ['element' => 'success']);
                        $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
                    }

                }
            }
            $this->set('temoignage', $temoignage);
        }
    }

    public function delete(){
        $this->menu();
        if(empty($this->request->params['?']['temoignage'])){
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['Controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['temoignage'];
            $temoignageTable = TableRegistry::get('temoignages');
            $temoignage = $temoignageTable->get($id);
            if (!$temoignage) {
                $this->Flash->error('Ce temoignage n\'existe pas.');
                $this->redirect(['Controller' => 'Users','action' => 'logout']);
            }else{
                $temoignageTable->delete($temoignage);
                $this->Flash->set('Votre temoignage a été supprimé avec succès.', ['element' => 'success']);
                $this->redirect(['action' => 'index']);
            }
        }
    }
}
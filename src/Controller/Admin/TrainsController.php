<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Table\MarquesTable;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class trainsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $user = $this->Auth->user();
        if($user){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->newEntity($user);
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
        $trainTable = TableRegistry::get('train');

        $train = $trainTable->find()->all();

        $this->set('train', $train);

        $this->render('index', 'default-admin');
    }

    public function add(){
        $this->menu();
        $trainTable = TableRegistry::get('trains');
        $categorieTable = TableRegistry::get('categories');
        $semaineTable = TableRegistry::get('semaines');
        if ($this->request->is('post')) {
            $train = $trainTable->newEntity($this->request->getData());
            if($this->request->getData()['Timage2']["name"] != ''){
                $train->Timage2 = $this->request->getData()["Timage2"]["name"];
                move_uploaded_file($this->request->getData()["Timage2"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage2"]["name"]);
            }
            $train->Timage1 = $this->request->getData()["Timage1"]["name"];
            move_uploaded_file($this->request->getData()["Timage1"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage1"]["name"]);
            $trainTable->save($train);
            $this->Flash->set('Votre train a été ajouté avec succès.', ['element' => 'success']);
            $this->redirect(['action' => 'index']);
        }
        $train = $trainTable->newEntity();
        $this->set(compact('train'));
        $this->set('_serialize', ['train']);

        $categories = $categorieTable->find()->all();
        $cat = array();
        foreach($categories as $categorie){
            $cat[$categorie->id] = $categorie->libelle;
        }
        $categories = $cat;
        $this->set('categories', $categories);
        $this->set('_serialize', ['categories']);

        $semaines = $semaineTable->find()->all();
        $sem = array();
        foreach($semaines as $semaine){
            $sem[$semaine->id] = $semaine->libelle;
        }
        $semaines = $sem;
        $this->set('semaines', $semaines);
        $this->set('_serialize', ['semaines']);

        $this->render('add', 'default-admin');
    }

    public function edit()
    {
        $this->menu();
        $categorieTable = TableRegistry::get('categories');
        $semaineTable = TableRegistry::get('semaines');

        if (empty($this->request->params['?']['train'])) {
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        } else {
            $id = (int)$this->request->params['?']['train'];
            $trainTable = TableRegistry::get('trains');
            $train = $trainTable->find()
                ->where(
                    [
                        'train.id' => $id,
                    ]
                )
                ->all();
            $train = $train->first();
            if (!$train) {
                $this->Flash->error('ce train n\'existe pas.');
                $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    $train_edit = $trainTable->newEntity($this->request->getData());
                    if($this->request->getData()['Timage1']['name'] != ''){
                        $train_edit->Timage1 = $this->request->getData()["Timage1"]["name"];
                        move_uploaded_file($this->request->getData()["Timage1"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage1"]["name"]);
                    }else{
                        $train_edit->Timage1 = $train->Timage1;
                    }
                    if($this->request->getData()['Timage2']["name"] != ''){
                        $train_edit->Timage2 = $this->request->getData()["Timage2"]["name"];
                        move_uploaded_file($this->request->getData()["Timage2"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage2"]["name"]);
                    }else{
                        $train_edit->Timage2 = $train->Timage2;
                    }
                    
                    $train_edit->id = $train->id;
                    if ($trainTable->save($train_edit)) {
                        $this->Flash->success('Votre train a été mise à jour avec succès.');
                        $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('Certains champs ont été mal saisis');
                    }
                }
            }
            
            $categories = $categorieTable->find()->all();
            $cat = array();
            foreach($categories as $categorie){
                $cat[$categorie->id] = $categorie->libelle;
            }
            $categories = $cat;
            $this->set('categories', $categories);
            $this->set('_serialize', ['categories']);

            $semaines = $semaineTable->find()->all();
            $sem = array();
            foreach($semaines as $semaine){
                $sem[$semaine->id] = $semaine->libelle;
            }
            $semaines = $sem;
            $this->set('semaines', $semaines);
            $this->set('_serialize', ['semaines']);
            $this->set('edit_train', $train);
            $this->render('edit', 'default-admin');
        }
    }

    public function delete(){
        $this->menu();
        if(empty($this->request->params['?']['train'])){
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['Controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['train'];
            $trainTable = TableRegistry::get('train');
            $train = $trainTable->get($id);
            if (!$train) {
                $this->Flash->error('Ce train n\'existe pas.');
                $this->redirect(['Controller' => 'Users','action' => 'logout']);
            }else{
                $trainTable->delete($train);
                $this->Flash->set('Votre train a été supprimé avec succès.', ['element' => 'success']);
                $this->redirect(['action' => 'index']);
            }
        }

    }
}
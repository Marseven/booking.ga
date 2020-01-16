<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Table\MarquesTable;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class trainController extends AppController
{

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
        $trn = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'trn' => $trn,
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
        if ($this->request->is('post')) {
            $trainTable = TableRegistry::get('train');
            $train = $trainTable->newEntity($this->request->getData());
            if($this->request->getData()['Timage2']["name"] != ''){
                $train->Timage2 = $this->request->getData()["Timage2"]["name"];
                move_uploaded_file($this->request->getData()["Timage2"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage2"]["name"]);
            }
            $train->Timage1 = $this->request->getData()["Timage1"]["name"];
            move_uploaded_file($this->request->getData()["Timage1"]["tmp_name"],"img/admin/img/trainimages/".$this->request->getData()["Timage1"]["name"]);
            if (isset($this->request->getData()["Transmission"]) && $this->request->getData()["Transmission"] == 'on'){
                $train->Transmission = 1;
            }else{
                $train->Transmission = 0;
            }
            $train->Nombre_reel = $this->request->getData()["Nombre"];
            $trainTable->save($train);
            $this->Flash->set('Votre train a été ajouté avec succès.', ['element' => 'success']);
            $this->redirect(['action' => 'index']);
        }
        $this->render('add', 'default-admin');
    }

    public function edit()
    {
        $this->menu();

        if (empty($this->request->params['?']['train'])) {
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        } else {
            $id = (int)$this->request->params['?']['train'];
            $trainTable = TableRegistry::get('train');
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
                    if (isset($this->request->getData()["Transmission"]) && $this->request->getData()["Transmission"] == 'on'){
                        $train_edit->Transmission = 1;
                    }else{
                        $train_edit->Transmission = 0;
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
            $this->set('train', $train);
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
<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Table\MarquesTable;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class VehiculesController extends AppController
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
        $marques = MarquesTable::marque();
        $this->set(compact('marques'));
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
        $vehiculeTable = TableRegistry::get('vehicules');

        $vehicules = $vehiculeTable->find()->contain('Marques')->all();

        $this->set('vehicules', $vehicules);

        $this->render('index', 'default-admin');
    }

    public function add(){
        $this->menu();
        if ($this->request->is('post')) {
            $vehiculeTable = TableRegistry::get('vehicules');
            $vehicule = $vehiculeTable->newEntity($this->request->getData());
            if($this->request->getData()['Vimage2']["name"] != ''){
                $vehicule->Vimage2 = $this->request->getData()["Vimage2"]["name"];
                move_uploaded_file($this->request->getData()["Vimage2"]["tmp_name"],"img/admin/img/vehicleimages/".$this->request->getData()["Vimage2"]["name"]);
            }
            $vehicule->Vimage1 = $this->request->getData()["Vimage1"]["name"];
            move_uploaded_file($this->request->getData()["Vimage1"]["tmp_name"],"img/admin/img/vehicleimages/".$this->request->getData()["Vimage1"]["name"]);
            if (isset($this->request->getData()["Transmission"]) && $this->request->getData()["Transmission"] == 'on'){
                $vehicule->Transmission = 1;
            }else{
                $vehicule->Transmission = 0;
            }
            $vehicule->Nombre_reel = $this->request->getData()["Nombre"];
            $vehiculeTable->save($vehicule);
            $this->Flash->set('Votre vehicule a été ajouté avec succès.', ['element' => 'success']);
            $this->redirect(['action' => 'index']);
        }
        $this->render('add', 'default-admin');
    }

    public function edit()
    {
        $this->menu();

        if (empty($this->request->params['?']['vehicule'])) {
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        } else {
            $id = (int)$this->request->params['?']['vehicule'];
            $vehiculeTable = TableRegistry::get('vehicules');
            $vehicule = $vehiculeTable->find()
                ->where(
                    [
                        'vehicules.id' => $id,
                    ]
                )
                ->all();
            $vehicule = $vehicule->first();
            if (!$vehicule) {
                $this->Flash->error('ce vehicule n\'existe pas.');
                $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    $vehicule_edit = $vehiculeTable->newEntity($this->request->getData());
                    if($this->request->getData()['Vimage1']['name'] != ''){
                        $vehicule_edit->Vimage1 = $this->request->getData()["Vimage1"]["name"];
                        move_uploaded_file($this->request->getData()["Vimage1"]["tmp_name"],"img/admin/img/vehicleimages/".$this->request->getData()["Vimage1"]["name"]);
                    }else{
                        $vehicule_edit->Vimage1 = $vehicule->Vimage1;
                    }
                    if($this->request->getData()['Vimage2']["name"] != ''){
                        $vehicule_edit->Vimage2 = $this->request->getData()["Vimage2"]["name"];
                        move_uploaded_file($this->request->getData()["Vimage2"]["tmp_name"],"img/admin/img/vehicleimages/".$this->request->getData()["Vimage2"]["name"]);
                    }else{
                        $vehicule_edit->Vimage2 = $vehicule->Vimage2;
                    }
                    if (isset($this->request->getData()["Transmission"]) && $this->request->getData()["Transmission"] == 'on'){
                        $vehicule_edit->Transmission = 1;
                    }else{
                        $vehicule_edit->Transmission = 0;
                    }
                    $vehicule_edit->id = $vehicule->id;
                    if ($vehiculeTable->save($vehicule_edit)) {
                        $this->Flash->success('Votre vehicule a été mise à jour avec succès.');
                        $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error('Certains champs ont été mal saisis');
                    }
                }
            }
            $this->set('vehicule', $vehicule);
            $this->render('edit', 'default-admin');
        }
    }

    public function delete(){
        $this->menu();
        if(empty($this->request->params['?']['vehicule'])){
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['Controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['vehicule'];
            $vehiculeTable = TableRegistry::get('vehicules');
            $vehicule = $vehiculeTable->get($id);
            if (!$vehicule) {
                $this->Flash->error('Ce vehicule n\'existe pas.');
                $this->redirect(['Controller' => 'Users','action' => 'logout']);
            }else{
                $vehiculeTable->delete($vehicule);
                $this->Flash->set('Votre vehicule a été supprimé avec succès.', ['element' => 'success']);
                $this->redirect(['action' => 'index']);
            }
        }

    }
}
<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Table\MarquesTable;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class MarquesController extends AppController
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
        $marqueTable = TableRegistry::get('Marques');

        $marques = $marqueTable->find()->all();

        $this->set('marques', $marques);

        $this->render('index', 'default-admin');
    }

    public function add(){
        $this->menu();

        if ($this->request->is('post')) {
            $marqueTable = TableRegistry::get('Marques');
            $marque = $marqueTable->newEntity($this->request->getData());
            $marqueTable->save($marque);
        }
        $this->render('add', 'default-admin');
    }

    public function edit()
    {
        $this->menu();

        if (empty($this->request->params['?']['marque'])) {
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        } else {
            $id = (int)$this->request->params['?']['marque'];
            $marqueTable = TableRegistry::get('Marques');
            $marque = $marqueTable->get($id);
            if (!$marque) {
                $this->Flash->error('Cette marque n\'existe pas.');
                $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            } else {
                if ($this->request->is(array('post', 'put'))) {
                    $marque = $marqueTable->newEntity($this->request->getData());
                    if ($marqueTable->save($marque)) {
                        $this->Flash->set('Votre marque a été mise à jour avec succès.', ['element' => 'success']);
                        $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->set('Certains champs ont été mal saisis', ['element' => 'error']);
                    }

                }
            }
            $this->set('marque', $marque);
            $this->render('edit', 'default-admin');
        }
    }

    public function delete(){
        $this->menu();
        if(empty($this->request->params['?']['marque'])){
            $this->Flash->error('Informations manquantes.');
            $this->redirect(['Controller' => 'Users','action' => 'logout']);
        }else{
            $id = (int)$this->request->params['?']['marque'];
            $marqueTable = TableRegistry::get('Marques');
            $marque = $marqueTable->get($id);
            if (!$marque) {
                $this->Flash->error('Cette marque n\'existe pas.');
                $this->redirect(['Controller' => 'Users','action' => 'logout']);
            }else{
                $marqueTable->delete($marque);
                $this->Flash->set('Votre marque a été supprimé avec succès.', ['element' => 'success']);
                $this->redirect(['action' => 'index']);
            }
        }

    }

}
<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Tarifs Controller
 *
 * @property \App\Model\Table\TarifsTable $Tarifs
 */
class TarifsController extends AppController
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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $villeTable = TableRegistry::get('villes');
        $classeTable = TableRegistry::get('classes');
        $categorieTable = TableRegistry::get('categories');
        

        $Tarifs = $this->paginate($this->Tarifs);
        if($id != null){
            $edit_tarif = $this->Tarifs->get($id);

            $this->set('edit_tarif', $edit_tarif);
            $this->set('_serialize', ['edit_tarif']);
        }else{
            $tarif = $this->Tarifs->newEntity();
            $this->set(compact('tarif'));
            $this->set('_serialize', ['tarif']);
        }
        $categories = $categorieTable->find()->all();
        $cat = array();
        foreach($categories as $categorie){
            $cat[$categorie->id] = $categorie->libelle;
        }
        $categories = $cat;
        $this->set('categories', $categories);
        $this->set('_serialize', ['categories']);
        
        $villes = $villeTable->find()->all();
        $vil = array();
        foreach($villes as $ville){
            $vil[$ville->id] = $ville->libelle;
        }
        $villes = $vil;
        $this->set('villes', $villes);
        $this->set('_serialize', ['villes']);

        $classes = $classeTable->find()->all();
        $cla = array();
        foreach($classes as $classe){
            $cla[$classe->id] = $classe->libelle;
        }
        $classes = $cla;
        $this->set('classes', $classes);
        $this->set('_serialize', ['classes']);
        
        $this->set(compact('Tarifs'));
        $this->set('_serialize', ['Tarifs']);
        $this->render('index', 'default-admin');
    }

    /**
     * View method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_Tarif = $this->Tarifs->get($id);

        $this->set('edit_tarif', $edit_tarif);
        $this->set('_serialize', ['edit_tarif']);

        $Tarifs = $this->paginate($this->Tarifs);
        $Tarif = $this->Tarifs->newEntity();
        $this->set(compact('Tarif'));
        $this->set('_serialize', ['Tarif']);
        $this->set(compact('Tarifs'));
        $this->set('_serialize', ['Tarifs']);
        $this->render('view', 'default-admin');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Tarif = $this->Tarifs->newEntity();
        if ($this->request->is('post')) {
            $Tarif = $this->Tarifs->patchEntity($Tarif, $this->request->data);
            //debug($Tarif);die;
            if ($this->Tarifs->save($Tarif)) {
                $this->Flash->success(__('La catégorie a été enregistré.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La catégorie n\'a pas été enregistré. S\'il vous plaît essayez plus tard.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Tarif = $this->Tarifs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Tarif = $this->Tarifs->patchEntity($Tarif, $this->request->data);
            if ($this->Tarifs->save($Tarif)) {
                $this->Flash->success(__('La catégorie a été modifié.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('La catégorie n\'a pas été modifié. S\'il vous plaît essayez plus tard.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $Tarif = $this->Tarifs->get($id);
        if ($this->Tarifs->delete($Tarif)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Tarif = $this->Tarifs->get($id);
        if ($this->Tarifs->moveUp($Tarif)) {
            $this->Flash->success('The Tarif has been moved Up.');
        } else {
            $this->Flash->error('The Tarif could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Tarif = $this->Tarifs->get($id);
        if ($this->Tarifs->moveDown($Tarif)) {
            $this->Flash->success('The Tarif has been moved down.');
        } else {
            $this->Flash->error('The Tarif could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}

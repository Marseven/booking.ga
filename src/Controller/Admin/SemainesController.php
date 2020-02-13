<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Semaines Controller
 *
 * @property \App\Model\Table\SemainesTable $Semaines
 */
class SemainesController extends AppController
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
        $categorieTable = TableRegistry::get('categories');

        $Semaines = $this->paginate($this->Semaines);
        if($id != null){
            $edit_semaine = $this->Semaines->get($id);

            $this->set('edit_semaine', $edit_semaine);
            $this->set('_serialize', ['edit_semaine']);
        }else{
            $semaine = $this->Semaines->newEntity();
            $this->set(compact('semaine'));
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

        $this->set('_serialize', ['Semaine']);
        $this->set(compact('Semaines'));
        $this->set('_serialize', ['Semaines']);
        $this->render('index', 'default-admin');
    }

    /**
     * View method
     *
     * @param string|null $id Semaine id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_Semaine = $this->Semaines->get($id);

        $this->set('edit_Semaine', $edit_Semaine);
        $this->set('_serialize', ['edit_Semaine']);

        $Semaines = $this->paginate($this->Semaines);
        $Semaine = $this->Semaines->newEntity();
        $this->set(compact('Semaine'));
        $this->set('_serialize', ['Semaine']);
        $this->set(compact('Semaines'));
        $this->set('_serialize', ['Semaines']);
        $this->render('view', 'default-admin');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Semaine = $this->Semaines->newEntity();
        if ($this->request->is('post')) {
            $Semaine = $this->Semaines->patchEntity($Semaine, $this->request->data);
            //debug($Semaine);die;
            if ($this->Semaines->save($Semaine)) {
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
     * @param string|null $id Semaine id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Semaine = $this->Semaines->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Semaine = $this->Semaines->patchEntity($Semaine, $this->request->data);
            if ($this->Semaines->save($Semaine)) {
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
     * @param string|null $id Semaine id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $Semaine = $this->Semaines->get($id);
        if ($this->Semaines->delete($Semaine)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Semaine = $this->Semaines->get($id);
        if ($this->Semaines->moveUp($Semaine)) {
            $this->Flash->success('The Semaine has been moved Up.');
        } else {
            $this->Flash->error('The Semaine could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Semaine = $this->Semaines->get($id);
        if ($this->Semaines->moveDown($Semaine)) {
            $this->Flash->success('The Semaine has been moved down.');
        } else {
            $this->Flash->error('The Semaine could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}

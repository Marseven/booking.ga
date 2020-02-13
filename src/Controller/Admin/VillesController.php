<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Villes Controller
 *
 * @property \App\Model\Table\VillesTable $Villes
 */
class VillesController extends AppController
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

        $Villes = $this->paginate($this->Villes);
        if($id != null){
            $edit_ville = $this->Villes->get($id);

            $this->set('edit_Ville', $edit_ville);
            $this->set('_serialize', ['edit_ville']);
        }else{
            $ville = $this->Villes->newEntity();
            $this->set(compact('ville'));
        }
        
        $this->set('_serialize', ['ville']);
        $this->set(compact('Villes'));
        $this->set('_serialize', ['Villes']);
        $this->render('index', 'default-admin');
    }

    /**
     * View method
     *
     * @param string|null $id Ville id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_Ville = $this->Villes->get($id);

        $this->set('edit_Ville', $edit_Ville);
        $this->set('_serialize', ['edit_Ville']);

        $Villes = $this->paginate($this->Villes);
        $Ville = $this->Villes->newEntity();
        $this->set(compact('Ville'));
        $this->set('_serialize', ['Ville']);
        $this->set(compact('Villes'));
        $this->set('_serialize', ['Villes']);
        $this->render('view', 'default-admin');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Ville = $this->Villes->newEntity();
        if ($this->request->is('post')) {
            $Ville = $this->Villes->patchEntity($Ville, $this->request->data);
            //debug($Ville);die;
            if ($this->Villes->save($Ville)) {
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
     * @param string|null $id Ville id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Ville = $this->Villes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Ville = $this->Villes->patchEntity($Ville, $this->request->data);
            if ($this->Villes->save($Ville)) {
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
     * @param string|null $id Ville id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $Ville = $this->Villes->get($id);
        if ($this->Villes->delete($Ville)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Ville = $this->Villes->get($id);
        if ($this->Villes->moveUp($Ville)) {
            $this->Flash->success('The Ville has been moved Up.');
        } else {
            $this->Flash->error('The Ville could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Ville = $this->Villes->get($id);
        if ($this->Villes->moveDown($Ville)) {
            $this->Flash->success('The Ville has been moved down.');
        } else {
            $this->Flash->error('The Ville could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}

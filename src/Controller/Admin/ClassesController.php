<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Classes Controller
 *
 * @property \App\Model\Table\ClassesTable $Classes
 */
class ClassesController extends AppController
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

        $Classes = $this->paginate($this->Classes);
        if($id != null){
            $edit_classes = $this->Classes->get($id);

            $this->set('edit_classe', $edit_classe);
            $this->set('_serialize', ['edit_classe']);
        }else{
            $classe = $this->Classes->newEntity();
            $this->set(compact('classe'));
        }
        $this->set('_serialize', ['Classe']);
        $this->set(compact('Classes'));
        $this->set('_serialize', ['Classes']);
        $this->render('index', 'default-admin');
    }

    /**
     * View method
     *
     * @param string|null $id Classe id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_classe = $this->Classes->get($id);

        $this->set('edit_classe', $edit_classe);
        $this->set('_serialize', ['edit_classe']);

        $Classes = $this->paginate($this->Classes);
        $Classe = $this->Classes->newEntity();
        $this->set(compact('Classe'));
        $this->set('_serialize', ['Classe']);
        $this->set(compact('Classes'));
        $this->set('_serialize', ['Classes']);
        $this->render('view', 'default-admin');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Classe = $this->Classes->newEntity();
        if ($this->request->is('post')) {
            $Classe = $this->Classes->patchEntity($Classe, $this->request->data);
            //debug($Classe);die;
            if ($this->Classes->save($Classe)) {
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
     * @param string|null $id Classe id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $Classe = $this->Classes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Classe = $this->Classes->patchEntity($Classe, $this->request->data);
            if ($this->Classes->save($Classe)) {
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
     * @param string|null $id Classe id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $Classe = $this->Classes->get($id);
        if ($this->Classes->delete($Classe)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Classe = $this->Classes->get($id);
        if ($this->Classes->moveUp($Classe)) {
            $this->Flash->success('The Classe has been moved Up.');
        } else {
            $this->Flash->error('The Classe could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $Classe = $this->Classes->get($id);
        if ($this->Classes->moveDown($Classe)) {
            $this->Flash->success('The Classe has been moved down.');
        } else {
            $this->Flash->error('The Classe could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}

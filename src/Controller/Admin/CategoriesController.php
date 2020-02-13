<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\FrozenTime;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
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

        $categories = $this->paginate($this->Categories);
        if($id != null){
            $edit_categorie = $this->Categories->get($id);

            $this->set('edit_categorie', $edit_categorie);
            $this->set('_serialize', ['edit_categorie']);
        }else{
            $categorie = $this->Categories->newEntity();
            $this->set(compact('categorie'));
        }
        $this->set('_serialize', ['categorie']);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
        $this->render('index', 'default-admin');
    }

    /**
     * View method
     *
     * @param string|null $id categorie id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $edit_categorie = $this->Categories->get($id);

        $this->set('edit_categorie', $edit_categorie);
        $this->set('_serialize', ['edit_categorie']);

        $categories = $this->paginate($this->Categories);
        $categorie = $this->Categories->newEntity();
        $this->set(compact('categorie'));
        $this->set('_serialize', ['categorie']);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
        $this->render('view', 'default-admin');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categorie = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $categorie = $this->Categories->patchEntity($categorie, $this->request->data);
            //debug($categorie);die;
            if ($this->Categories->save($categorie)) {
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
     * @param string|null $id categorie id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $categorie = $this->Categories->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categorie = $this->Categories->patchEntity($categorie, $this->request->data);
            if ($this->Categories->save($categorie)) {
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
     * @param string|null $id Categorie id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $categorie = $this->Categories->get($id);
        if ($this->Categories->delete($categorie)) {
            $this->Flash->success(__('La catégorie a été supprimée.'));
        } else {
            $this->Flash->error(__('La catégorie ne peut être supprimée. Essayez plus tard.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $categorie = $this->Categories->get($id);
        if ($this->Categories->moveUp($categorie)) {
            $this->Flash->success('The categorie has been moved Up.');
        } else {
            $this->Flash->error('The categorie could not be moved up. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $categorie = $this->Categories->get($id);
        if ($this->Categories->moveDown($categorie)) {
            $this->Flash->success('The categorie has been moved down.');
        } else {
            $this->Flash->error('The categorie could not be moved down. Please, try again.');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}

<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use App\Form\ContactForm;

class ContactController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
        $user = $this->Auth->user();
        if(isset($user)){
            $user['confirmed_at'] = new FrozenTime($user['confirmed_at']);
            $user['reset_at'] = new FrozenTime($user['reset_at']);
            $this->set('user', $user);
        }

    }

    public function index()
    {
        $acc = '';
        $tra = '';
        $dms = '';

        $this->set(array(
            'acc' => $acc,
            'tra' => $tra,
            'dms' => $dms,
        ));

        $contact = new ContactForm();
        if ($this->request->is('post')) {
            if ($contact->execute($this->request->getData())) {
                $this->Flash->success('Merci, Nous reviendrons vers vous rapidement.');
            } else {
                $this->Flash->error('Il y a eu un problème lors de la soumission du formulaire.');
            }
        }
        $this->set('contact', $contact);
        //return $this->redirect(['controller' => 'Contact', 'action'=>'index']);
    }
}
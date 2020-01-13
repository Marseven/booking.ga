<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Utility\Hash;

class UsersTable extends Table
{

    public function initialize(array $config)
    {
        $this->table('users');
        $this->hasMany('Reservations')
             ->setForeignKey('userEmail')
             ->setDependent(true);
        $this->hasMany('temoignages')
             ->setForeignKey('UserEmail')
             ->setDependent(true);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('LastName')
            ->notEmpty('LastName', 'Ce champ doit être rempli.')
            ->requirePresence('Email')
            ->add('Email', [
                'length' => [
                    'rule' => 'email',
                    'message' => 'Ex : abc@xyz.cfr',
                ]
            ])
            ->requirePresence('ContactNo')
            ->notEmpty('ContactNo', 'Ce champ doit être rempli.')
            ->requirePresence('City')
            ->notEmpty('City', 'Ce champ doit être rempli.')
            ->requirePresence('Password')
            ->notEmpty('Password', 'Ce champ doit être rempli.')
            ->requirePresence('Password_verify')
            ->notEmpty('Password_verify', 'Ce champ doit être rempli.');

        return $validator;
    }

}
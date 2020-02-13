<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class VillesTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Users')
        ->setForeignKey('id_user') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');

        $this->hasMany('Semaines')
        ->setForeignKey('id_ville') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');

        $this->hasMany('Tarifs')
        ->setForeignKey('id_ville') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');
    }
}
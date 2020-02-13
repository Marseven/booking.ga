<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SemainesTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Users')
        ->setForeignKey('id_user') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');

        $this->belongsTo('Villes')
        ->setForeignKey('id_ville') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');

        $this->hasMany('Tarifs')
        ->setForeignKey('id_semaine') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');
    }
}
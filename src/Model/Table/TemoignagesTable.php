<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TemoignagesTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Users')
        ->setForeignKey('UserEmail') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');
    }
}
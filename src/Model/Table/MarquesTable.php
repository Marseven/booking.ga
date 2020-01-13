<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class MarquesTable extends Table
{

    public function initialize(array $config)
    {
        $this->hasMany('Vehicules')
            ->setForeignKey('VehiclesBrand')
            ->setDependent(true);
    }

    static function marque(){
        $marques = array();
        $marqueTable = TableRegistry::get('Marques');
        $marq = $marqueTable->find()->all();
        foreach($marq as $mq){
            $marques[$mq->id] = $mq->BrandName;
        }
        return $marques;
    }
}
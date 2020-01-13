<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class VehiculesTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Marques')
            ->setForeignKey('VehiclesBrand') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
            ->setJoinType('INNER');
        $this->hasMany('reservations')
            ->setForeignKey('VehicleId')
            ->setDependent(true);
    }

    static function is_avaible(array $data){
        $dispo = true;
        $reservationTable = TableRegistry::get('reservations');
        $vehiculeTable = TableRegistry::get('vehicules');

        $reservation = $reservationTable->find()
            ->where(
                [
                    'VehicleId' => $data['vid'],
                ]
            )
            ->all();
        $id=intval($data['vid']);
        $vehicule = $vehiculeTable->find()
            ->contain(['Marques'])
            ->where(
                [
                    'vehicules.id' => $id,
                ]
            )
            ->all();
        $vehicule = $vehicule->first();
        if($reservation->count() > 0)
        {
            foreach($reservation as $q){
                $date_depart = new \DateTime($q->FromDate);
                $date_arriver = new \DateTime($q->ToDate);

                if(($data['date_depart'] < $date_depart && $data['date_arriver'] < $date_depart) || ($data['date_depart'] > $date_depart && $data['date_arriver'] > $date_depart && $data['date_depart'] > $date_arriver && $data['date_arriver'] > $date_arriver)) {
                    $dispo = true;
                    if ($vehicule->Nombre_reel == 0) {
                        $dispo = false;
                        break;
                    }
                }else{
                    if ($vehicule->Nombre_reel > 0) {
                        $dispo = true;
                    }else{
                        $dispo = false;
                        break;
                    }
                }
            }
        }else{
            return $dispo;
        }
        return $dispo;
    }
}
<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class TriansTable extends Table
{

    public function initialize(array $config)
    {
        
        $this->hasMany('reservations')
            ->setForeignKey('TrainId')
            ->setDependent(true);
    }

    static function is_avaible(array $data){
        $dispo = true;
        $reservationTable = TableRegistry::get('reservations');
        $vehiculeTable = TableRegistry::get('Trains');

        $reservation = $reservationTable->find()
            ->where(
                [
                    'TrainId' => $data['vid'],
                ]
            )
            ->all();
        $id=intval($data['vid']);
        $vehicule = $vehiculeTable->find()
            ->where(
                [
                    'trains.id' => $id,
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
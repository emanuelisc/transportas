<?php

namespace AppBundle\Utils;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\Form;
use AppBundle\Entity\Vehicle;

class CalculateReport
{
    public function calculateKm(Form $form){
        $mileage1 = $form["depart_km"]->getData();
        $mileage2 = $form["arrive_km"]->getData();
        return $mileage2 - $mileage1;
    }

    public function calculateFuel(Form $form, Vehicle $vehicle){
        $depart1 = $form["depart_time"]->getData()->format('h') * 60;
        $arrive1 = $form["arrive_time"]->getData()->format('h') * 60;
        $unload_time = $form["unload_time"]->getData();
        $depart2 = $form["depart2_time"]->getData()->format('h') * 60;
        $arrive2 = $form["arrive2_time"]->getData()->format('h') * 60;

        $depart1 = $depart1 + $form["depart_time"]->getData()->format('i');
        $arrive1 = $arrive1 + $form["arrive_time"]->getData()->format('i');
        $depart2 = $depart2 + $form["depart2_time"]->getData()->format('i');
        $arrive2 = $arrive2 + $form["arrive2_time"]->getData()->format('i');

        $drive = $vehicle->getDrive();
        $stand = $vehicle->getStand();
        $unload = $vehicle->getUnload();

        $fuel1 = ($arrive1 - $depart1) * $drive;
        $fuel2 = $unload_time * $unload;
        $fuel3 = ($depart2 - $arrive1 + $unload_time) * $stand ;
        $fuel4 = ($arrive2 - $depart2) * $drive;

        return ($fuel1 + $fuel2 + $fuel3 + $fuel4)/60;
    }
}
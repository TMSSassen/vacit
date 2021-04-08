<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Entity\Vacature;
use Symfony\Component\Security\Core\User\User;
use DateTime;

/**
 * Description of NieuweVacatureService
 *
 * @author TSassen
 */
class NieuweVacatureService {
    //put your code here
    
    public function createNewVacature()
    {
        $vacature=new Vacature();
        $vacature->setDatum(new DateTime('now'));
        $vacature->setBedrijf($user);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Entity\Sollicitatie;

/**
 * Description of NieuweSollicitatieService
 *
 * @author TSassen
 */
class NieuweSollicitatieService {
    //put your code here
    public function createNewSollicitatie($user,$vacature,$motivatie)
    {
        $newSol=new Sollicitatie();
        $newSol->setDatum(new DateTime('now'));
        $newSol->setVacature($vacature);
        $newSol->setUser($user);
        $newSol->setMotivatie($motivatie);
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use App\Entity\Solicitatie;

/**
 * Description of NieuweSollicitatieService
 *
 * @author TSassen
 */
class NieuweSolicitatieService {
    //put your code here
    public function createNewSollcitatie($user,$vacature)
    {
        $newSol=new Solicitatie();
        $newSol->setDatum(new DateTime('now'));
        $newSol->setVacature($vacature);
    }
}

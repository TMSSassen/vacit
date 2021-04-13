<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use \App\Repository\VacatureRepository;
use \Symfony\Component\Serializer\Encoder\EncoderInterface;
/**
 * Description of VacaturesHomepageEncoderService
 *
 * @author TSassen
 */
class VacaturesHomepageEncoderService {

    /**
     * @var \Symfony\Component\Serializer\Encoder\JsonEncoder
     */
    private $encoder;

    /**
     * @var \App\Repository\VacatureRepository
     */
    private $vacRep;

    //put your code here
    
    public function __construct(VacatureRepository $vacRep, EncoderInterface  $encoder) {
        $this->vacRep = $vacRep;
        $this->encoder = $encoder;
    }
    
    public function getAllAsJSON()
    {
        $vacatures=$this->vacRep->findAll();
        $toEncode=[];
        foreach($vacatures as $vacature)
        {
            /* @var $vacature Vacature*/
            $toEncode[]=array(
                "titel"=>$vacature->getTitel(),
                "platform"=>$vacature->getPlatform()->getNaam(),
                "bedrijf"=>$vacature->getBedrijf()->getUsername(),
                "standplaats"=>$vacature->getStandplaats(),
                "niveau"=>$vacature->getNiveau()
            );
            
        }
        return $this->encoder->encode($toEncode, 'json');
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use \App\Service\NieuweVacatureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vacature;
use \App\Repository\VacatureRepository;

/**
 * Description of VacatureOverzichtController
 *
 * @author TSassen
 */
class VacatureOverzichtController  extends AbstractController{

    /**
     * @var \App\Repository\VacatureRepository
     */
    private $vacRep;

    /**
     * @var \App\Service\NieuweVacatureService
     */
    private $newVacService;
    
    public function __construct(VacatureRepository $vacRep,NieuweVacatureService $newVacService) {
        $this->newVacService = $newVacService;
        $this->vacRep = $vacRep;
    }
    /**
     * @Route("/vacature/overzicht", name="vacature_overzicht")
     */
    public function vacatureOverzicht(Request $request): Response
    {
        return $this->render('vacature_overzicht/VacatureOverzicht.html.twig', [
            'controller_name' => 'VacatureOverzichtController',
            'all_vacatures'=>$this->vacRep->findAll()
        ]);
    }
}

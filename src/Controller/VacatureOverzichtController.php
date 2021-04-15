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
    //put your code here
    /**
     * @Route("/vacature/overzicht", name="vacature_overzicht")
     */
    public function vacatureOverzicht(Request $request): Response
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweVacature', $submittedToken)) {
            $this->newVacService->createNewVacature($this->getUser(),
                    $request->request->get('beschrijving'),
                    $request->request->get('niveau'),
                    $request->request->get('titel'),
                    $request->request->get('platform'));
        }
        return $this->render('sollicitatie_overzicht/VacatureOverzicht.html.twig', [
            'controller_name' => 'VacatureOverzichtController',
            'all_vacatures'=>$this->vacRep->findAll()
        ]);
    }
}

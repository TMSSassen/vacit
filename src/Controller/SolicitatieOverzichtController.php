<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SolicitatieOverzichtController extends AbstractController
{

    /**
     * @var \App\Service\NieuweVacatureService
     */
    private $newVacService;

    /**
     * @var \App\Service\NieuweSolicitatieService
     */
    private $newSolService;

    public function __construct(\App\Service\NieuweSolicitatieService $newSolService,
            \App\Service\NieuweVacatureService $newVacService) {
        ;
        $this->newSolService = $newSolService;
        $this->newVacService = $newVacService;
    }
    /**
     * @Route("/solicitatie/overzicht", name="solicitatie_overzicht")
     */
    public function index(Request $request): Response
    {        
        return $this->render('solicitatie_overzicht/index.html.twig', [
            'controller_name' => 'SolicitatieOverzichtController',
        ]);
    }
    /**
     * @Route("/vacature/overzicht", name="vacature_overzicht")
     */
    public function vacatureOverzicht(Request $request): Response
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweSolicitatie', $submittedToken)) {
            
        }
        return $this->render('solicitatie_overzicht/index.html.twig', [
            'controller_name' => 'SolicitatieOverzichtController',
        ]);
    }
}

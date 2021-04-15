<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vacature;

class SollicitatieOverzichtController extends AbstractController
{

    /**
     * @var \App\Service\NieuweVacatureService
     */
    private $newVacService;

    /**
     * @var \App\Service\NieuweSollicitatieService
     */
    private $newSolService;

    public function __construct(\App\Service\NieuweSollicitatieService $newSolService,
            \App\Service\NieuweVacatureService $newVacService) {
        ;
        $this->newSolService = $newSolService;
        $this->newVacService = $newVacService;
    }
    /**
     * @Route("/sollicitatie/overzicht", name="sollicitatie_overzicht")
     */
    public function index(Request $request): Response
    {        
        return $this->render('sollicitatie_overzicht/SollicitatieOverzicht.html.twig', [
            'controller_name' => 'SollicitatieOverzichtController',
        ]);
    }
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
            'controller_name' => 'SollicitatieOverzichtController',
        ]);
    }
}

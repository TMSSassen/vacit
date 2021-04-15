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
     * @var \App\Service\NieuweSollicitatieService
     */
    private $newSolService;

    public function __construct(\App\Service\NieuweSollicitatieService $newSolService) {
        ;
        $this->newSolService = $newSolService;
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
}

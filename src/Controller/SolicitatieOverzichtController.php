<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SolicitatieOverzichtController extends AbstractController
{
    /**
     * @Route("/solicitatie/overzicht", name="solicitatie_overzicht")
     */
    public function index(): Response
    {
        return $this->render('solicitatie_overzicht/index.html.twig', [
            'controller_name' => 'SolicitatieOverzichtController',
        ]);
    }
    /**
     * @Route("/vacature/overzicht", name="vacature_overzicht")
     */
    public function vacatureOverzicht(): Response
    {
        return $this->render('solicitatie_overzicht/index.html.twig', [
            'controller_name' => 'SolicitatieOverzichtController',
        ]);
    }
}

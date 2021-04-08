<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SolicitatieOverzichtController extends AbstractController
{
    /**
     * @Route("/solicitatie/overzicht", name="solicitatie_overzicht")
     */
    public function index(Request $request): Response
    {        
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweSolicitatie', $submittedToken)) {
            
        }
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

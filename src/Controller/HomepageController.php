<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VacatureRepository;
use \App\Service\VacaturesHomepageEncoderService;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(VacatureRepository $vacRep, VacaturesHomepageEncoderService  $encodeService): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'all_vacatures_json'=>$encodeService->getAllAsJSON(),
            'most_recent'=>$vacRep->getMostRecent()
        ]);
    }
}

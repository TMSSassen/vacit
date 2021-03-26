<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacatureDetailController extends AbstractController
{
    /**
     * @Route("/vacature/detail", name="vacature_detail")
     */
    public function index(): Response
    {
        return $this->render('vacature_detail/index.html.twig', [
            'controller_name' => 'VacatureDetailController',
        ]);
    }
}

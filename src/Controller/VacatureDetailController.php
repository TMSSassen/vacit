<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\NieuweSollicitatieService;
use App\Repository\VacatureRepository;

class VacatureDetailController extends AbstractController
{

    /**
     * @var \App\Repository\VacatureRepository
     */
    private $vacRepos;

    /**
     * @var NieuweSollicitatieService
     */
    private $newSolService;

    public function __construct(NieuweSollicitatieService $newSolService, VacatureRepository $vacRepos) {
        ;
        $this->newSolService = $newSolService;
        $this->vacRepos = $vacRepos;
    }
    /**
     * @Route("/vacature/detail/{id}", name="vacature_detail")
     */
    public function index(Request $request,$id): Response
    {
        $vacature=$this->vacRepos->find($id);
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweSollicitatie', $submittedToken)) {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $this->newSolService->createNewSollicitatie($this->getUser(), $vacature);
        }
        $vacatures=$this->vacRepos->findAllOfBedrijf($vacature->getBedrijf());
        return $this->render('vacature_detail/index.html.twig', [
            'controller_name' => 'VacatureDetailController',
            'similar_vacatures' => $vacatures
        ]);
    }
}

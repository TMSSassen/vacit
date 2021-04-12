<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\BrowserKit\Request;
use App\Service\NieuweSolicitatieService;

class VacatureDetailController extends AbstractController
{

    /**
     * @var \App\Repository\VacatureRepository
     */
    private $vacRepos;

    /**
     * @var NieuweSolicitatieService
     */
    private $newSolService;

    public function __construct(NieuweSolicitatieService $newSolService, \App\Repository\VacatureRepository $vacRepos) {
        ;
        $this->newSolService = $newSolService;
        $this->vacRepos = $vacRepos;
    }
    /**
     * @Route("/vacature/detail/{id}", name="vacature_detail")
     */
    public function index($id): Response
    {
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweSolicitatie', $submittedToken)) {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $vacature=$this->vacRepos->find($id);
            $this->newSolService->createNewSolicitatie($this->getUser(), $vacature);
        }
        return $this->render('vacature_detail/index.html.twig', [
            'controller_name' => 'VacatureDetailController',
        ]);
    }
}

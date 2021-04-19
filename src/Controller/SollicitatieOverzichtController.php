<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\NieuweVacatureService;
use App\Repository\VacatureRepository;
use App\Repository\UserRepository;
use App\Repository\SollicitatieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\UitnodigService;
use App\Entity\Vacature;

class SollicitatieOverzichtController extends AbstractController {

    /**
     * @var UitnodigService
     */
    private $nodigUit;

    /**
     * @var SollicitatieRepository
     */
    private $solRep;

    /**
     * @var VacatureRepository
     */
    private $vacRep;

    /**
     * @var UserRepository
     */
    private $userRep;

    /**
     * @var \App\Service\NieuweSollicitatieService
     */
    private $newVacService;

    public function __construct(NieuweVacatureService $newVacService,
            VacatureRepository $vacRep, UserRepository $userRep,
            SollicitatieRepository $solRep, UitnodigService $nodigUit) {
        $this->newVacService = $newVacService;
        $this->vacRep = $vacRep;
        $this->userRep = $userRep;
        $this->solRep = $solRep;
        $this->nodigUit = $nodigUit;
    }

    private function denyAccessUnlessAllowed($id) {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYER');
        $vacature = is_numeric($id)?$this->vacRep->find($id):$id;
        if (($vacature === null || $vacature->getBedrijf() != $this->getUser() ) && !$this->isGranted('ROLE_ADMIN')) {
            throw new AuthenticationException('This is a vacature of a different company');
        }
    }

    /**
     * @Route("/bedrijf/sollicitatie/nodiguit/","nodig_uit")
     */
    public function nodigUitAjax(Request $request, $id): Response {
        $sol_id=$request->request->get('sol_id');
        $sollicitatie=$this->solRep->find($sol_id);
        $this->denyAccessUnlessAllowed($sollicitatie->getVacature());
        return $this->nodigUit->handleUitnodigRequest($request);
    }

    /**
     * @Route("/bedrijf/sollicitatie/overzicht/{id}", name="bedrijf_sollicitatie_overzicht"
     */
    public function allSollicitatiesOnVacature(Request $request, $id): Response {
        $this->denyAccessUnlessAllowed($id);
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('nieuweVacature', $submittedToken)) {
            $this->newVacService->createNewVacature($this->getUser(),
                    $request->request->get('beschrijving'),
                    $request->request->get('niveau'),
                    $request->request->get('titel'),
                    $request->request->get('platform'));
        }
        $findCriteria = ['Vacature_id' => $id];
        return $this->render('sollicitatie_overzicht/SollicitatieOverzicht_employer.html.twig', [
                    'controller_name' => 'SollicitatieOverzichtController',
                    'all_sollicitaties' => $this->solRep->findBy($findCriteria)
        ]);
    }

    /**
     * @Route("/kandidaat/sollicitatie/overzicht/", name="kandidaat_sollicitatie_overzicht"
     */
    public function allSollicitatiesOfUser(Request $request) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $findCriteria = ['user' => $this->getUser()];
        return $this->render('sollicitatie_overzicht/SollicitatieOverzicht_candidate.html.twig', [
                    'controller_name' => 'SollicitatieOverzichtController',
                    'all_sollicitaties' => $this->solRep->findBy($findCriteria)
        ]);
    }
    /**
     * @Route("/kandidaat/sollicitatie/checkUitnodiging/", name="check_uitgenodigd"
     */
    public function allAcceptedSollicitatiesOfUser(Request $request)
    {
        if($this->isGranted('ROLE_CANDIDATE')){
            return $this->nodigUit->handleCheckUitnodiging($request, $this->solRep,$this->getUser());            
        }
        return new JsonResponse(["success"=>false]);
    }

}

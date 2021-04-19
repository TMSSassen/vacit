<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

use Swoole\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SollicitatieRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of UitnodigService
 *
 * @author TSassen
 */
class UitnodigService {

    //put your code here

    public function handleUitnodigRequest(Request $request, SollicitatieRepository $solRep) {
        $submittedToken = $request->request->get('token');
        $sol_id = $request->request->get('id');
        $ajaxResponse = ['success' => false];
        if ($this->isCsrfTokenValid('nodigUit', $submittedToken)) {
            $sollicitatie=$solRep->find($sol_id);
            $sollicitatie->setUitgenodigd(true);
            $solRep->persist($sollicitatie);
            $ajaxResponse = ['success'=>true];
        }
        return new JsonResponse($ajaxResponse);
    }
    
    public function handleCheckUitnodiging(Request $request, SollicitatieRepository $solRep, User $user)
    {
        $findCriteria=["user"=>$user,"uitgenodigd"=>true];
        $sollicitaties=$solRep->findBy($findCriteria);
        $ajaxResponse=['success'=>true,"uitgenodigd"=>$sollicitaties];
        return new JsonResponse($ajaxResponse);
    }

}

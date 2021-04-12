<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Repository\UserRepository;

class ProfielController extends AbstractController
{
    /**
     * @Route("/profiel/{id}", name="profiel")
     */
    public function index(Request $request, UserRepository $usRep,$id): Response
    {
        $currentUser=$this->getUser();
        $profile=$usRep->find($id);
        if(!$profile){
            throw new InvalidParameterException();
        }
        if($currentUser->getId()===$id || $this->isGranted('ROLE_ADMIN'))
        {
            return $this->editableTemplate($request,$profile);
        }
        return $this->uneditableTemplate($profile);
    }
    
    private function editableTemplate(Request $request,User $profile){
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('editprofile', $submittedToken)) {
            
        }
        return $this->render('profiel/index.html.twig', [
            'controller_name' => 'ProfielController',
            'user'=>$profile
        ]);
    }
    private function uneditableTemplate(User $profile){
        return $this->render('profiel/fixed.html.twig', [
            'controller_name' => 'ProfielController',
            'user'=>$profile
        ]);        
    }
}

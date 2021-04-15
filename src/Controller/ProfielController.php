<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\FileUploadService;

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
        if($this->isGranted('ROLE_ADMIN')
                || ($this->isGranted('IS_AUTHENTICATED_FULLY') && $currentUser->getId()==$id ))
        {
            return $this->editableTemplate($request,$profile);
        }
        return $this->uneditableTemplate($profile);
    }
    
    /**
     * @Route("/profiel/upload/{id}", name="profiel_upload")
     */
    public function ajaxUpload(Request $request, UserRepository $usRep,$id)
    {
        [$success,$result]=FileUploadService::upload_file();
        $v= json_encode($result);
        $response= new Response($v);
        $response->headers->set('Content-Type','application/json');
        return($response);
    }
    
    private function editableTemplate(Request $request,User $profile){
        $submittedToken = $request->request->get('token');
        if ($this->isCsrfTokenValid('editprofile', $submittedToken)) {
            
        }
        return $this->render('profiel/index.html.twig', [
            'controller_name' => 'ProfielController',
            'user'=>$profile,
            'upload_path'=>'profiel_upload',
            'id'=>$profile->getID()
        ]);
    }
    private function uneditableTemplate(User $profile){
        return $this->render('profiel/fixed.html.twig', [
            'controller_name' => 'ProfielController',
            'user'=>$profile
        ]);        
    }
}

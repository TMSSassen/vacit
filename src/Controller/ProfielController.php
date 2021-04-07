<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Request;

class ProfielController extends AbstractController
{
    /**
     * @Route("/profiel", name="profiel")
     */
    public function index(Request $request): Response
    {
        
        $user = new \App\Entity\User();
        $form = $this->createForm(\App\Form\Type\ProfielCandidateType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->addRol('ROLE_CANDIDATE');
            $newUserService->registerUser($user);
            return $this->redirectToRoute('task_success');
        }
        return $this->render('profiel/index.html.twig', [
            'controller_name' => 'ProfielController',
            'form'=>$form->createView()
        ]);
    }
}

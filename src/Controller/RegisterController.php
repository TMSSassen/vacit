<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/success", name="task_success")
     */
    public function registerSuccess()
    {
        
    }
    /**
     * @Route("/register", name="register")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request, \App\Service\RegisterNewUserService $newUserService): Response
    {
        
        $user = new \App\Entity\User();
        $form = $this->createForm(\App\Form\Type\UserRegType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->addRol('ROLE_CANDIDATE');
            $newUserService->registerUser($user);
            return $this->redirectToRoute('task_success');
        }
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'form'=>$form->createView()
        ]);
    }
}

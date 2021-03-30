<?php
namespace App\Service;

use \Doctrine\ORM\EntityManager;
use App\Entity\User;

class RegisterNewUserService
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em) {
        ;
        $this->em = $em;
    }
    
    public function registerUser(User $user){}
}
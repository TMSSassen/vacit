<?php
namespace App\Service;

use \Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterNewUserService
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em,ValidatorInterface $validator,UserPasswordEncoderInterface $passwordEncoder) {
        
        $this->em = $em;
        $this->validator = $validator;
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function registerUser(User $user)
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user,$user->getPassword()));
        $errors=$this->validator->validate($user);
        $this->em->persist($user);
        $this->em->flush();
    }
}
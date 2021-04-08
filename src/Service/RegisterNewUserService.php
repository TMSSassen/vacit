<?php
namespace App\Service;

use \Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\InputBag;
use DateTime;

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
    
    public function getUserFromFields(\Symfony\Component\HttpFoundation\InputBag $fields):User
    {
        $user = new User();
        $date = new DateTime();
        $date->setTimestamp(strtotime($fields->get('geboortedatum')));
        $user->setVoornaam($fields->get('voornaam'));
        $user->setAchternaam($fields->get('achternaam'));
        $user->setEmail($fields->get('email'));
        $user->setPassword($fields->get('password'));
        $user->setGeboortedatum($date);
        $user->setAdres($fields->get('adres'));
        $user->setPostcode($fields->get('postcode'));
        $user->setTelefoonnummer($fields->get('telefoonnummer'));
        $user->setWoonplaats($fields->get('woonplaats'));
        return $user;
    }
    
    public function registerUser(User $user)
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user,$user->getPassword()));
        $errors=$this->validator->validate($user);
        $this->em->persist($user);
        $this->em->flush();
    }
}
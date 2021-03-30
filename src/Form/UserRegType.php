<?php
// src/Form/Type/TaskType.php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserRegType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('voornaam', TextType::class)
            ->add('achternaam', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('geboortedatum', DateType::class)
            ->add('telefoonnummer', TextType::class)
            ->add('adres', TextType::class)
            ->add('postcode', TextType::class)
            ->add('woonplaats', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }
}
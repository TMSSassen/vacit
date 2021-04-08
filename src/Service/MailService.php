<?php
namespace App\Service;

use App\Entity\User;

class MailService
{
    public function sendRegistrationMail(User $user)
    {
        $email=$user->getEmail();
        $naam=$user->getVoornaam().' '.$user->getAchternaam();
        $mailText="Beste $naam, uw wachtwoord is ".$user->getPassword();
    }
}
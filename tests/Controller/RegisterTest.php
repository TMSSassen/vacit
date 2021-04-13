<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase{
    //put your code here
    
    public function testHomepage(){
        
        $client = static::createClient();

        $client->request('GET', '/register');
        $csrfToken = $client->getContainer()->get('form.csrf_provider')->generateCsrfToken('registration');
    $crawler = $client->request('POST', '/ajax/register', array(
        'fos_user_registration_form' => array(
            '_token' => $csrfToken,
            'username' => 'samplelogin',
            'email' => 'sample@fake.pl',
            'plainPassword' => array(
                'first' => 'somepass',
                'second' => 'somepass',
            ),
            'name' => 'sampleuser',
            'type' => 'DSWP',
        ),
    ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

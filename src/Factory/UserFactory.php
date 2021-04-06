<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static User|Proxy find($criteria)
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy first(string $sortedField = 'id')
 * @method static User|Proxy last(string $sortedField = 'id')
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create($attributes = [])
 */
final class UserFactory extends ModelFactory
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(\Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->passwordEncoder=$passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }

    protected function getDefaults(): array
    {
        return [
            'voornaam'=>$this->faker->firstName(),
            'geboortedatum'=>$this->faker->dateTimeBetween('-70 years', '-20 years'),
            'achternaam'=>$this->faker->lastName(),
            'email'=>$this->faker->email(),
            'adres'=>$this->faker->streetAddress(),
            'telefoonnummer'=>$this->faker->phoneNumber(),
            'woonplaats'=>$this->faker->city(),
            'postcode'=>$this->faker->postcode(),
            'roles'=>[$this->faker->randomElement(['ROLE_CANDIDATE','ROLE_EMPLOYER'])]
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(User $user) {
                $user->setPassword($this->passwordEncoder->encodePassword($user, $this->faker->password()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}

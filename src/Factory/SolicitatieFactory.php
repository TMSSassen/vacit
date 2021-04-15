<?php

namespace App\Factory;

use App\Entity\Sollicitatie;
use App\Repository\SollicitatieRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Sollicitatie|Proxy createOne(array $attributes = [])
 * @method static Sollicitatie[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Sollicitatie|Proxy find($criteria)
 * @method static Sollicitatie|Proxy findOrCreate(array $attributes)
 * @method static Sollicitatie|Proxy first(string $sortedField = 'id')
 * @method static Sollicitatie|Proxy last(string $sortedField = 'id')
 * @method static Sollicitatie|Proxy random(array $attributes = [])
 * @method static Sollicitatie|Proxy randomOrCreate(array $attributes = [])
 * @method static Sollicitatie[]|Proxy[] all()
 * @method static Sollicitatie[]|Proxy[] findBy(array $attributes)
 * @method static Sollicitatie[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Sollicitatie[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SollicitatieRepository|RepositoryProxy repository()
 * @method Sollicitatie|Proxy create($attributes = [])
 */
final class SollicitatieFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'datum'=>$faker->dateTimeBetween('-3 months', 'now')
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Sollicitatie $sollicitatie) {})
        ;
    }

    protected static function getClass(): string
    {
        return Sollicitatie::class;
    }
}

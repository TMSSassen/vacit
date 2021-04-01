<?php

namespace App\Factory;

use App\Entity\Solicitatie;
use App\Repository\SolicitatieRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Solicitatie|Proxy createOne(array $attributes = [])
 * @method static Solicitatie[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Solicitatie|Proxy find($criteria)
 * @method static Solicitatie|Proxy findOrCreate(array $attributes)
 * @method static Solicitatie|Proxy first(string $sortedField = 'id')
 * @method static Solicitatie|Proxy last(string $sortedField = 'id')
 * @method static Solicitatie|Proxy random(array $attributes = [])
 * @method static Solicitatie|Proxy randomOrCreate(array $attributes = [])
 * @method static Solicitatie[]|Proxy[] all()
 * @method static Solicitatie[]|Proxy[] findBy(array $attributes)
 * @method static Solicitatie[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Solicitatie[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SolicitatieRepository|RepositoryProxy repository()
 * @method Solicitatie|Proxy create($attributes = [])
 */
final class SolicitatieFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Solicitatie $solicitatie) {})
        ;
    }

    protected static function getClass(): string
    {
        return Solicitatie::class;
    }
}

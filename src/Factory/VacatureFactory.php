<?php

namespace App\Factory;

use App\Entity\Vacature;
use App\Repository\VacatureRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Vacature|Proxy createOne(array $attributes = [])
 * @method static Vacature[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Vacature|Proxy find($criteria)
 * @method static Vacature|Proxy findOrCreate(array $attributes)
 * @method static Vacature|Proxy first(string $sortedField = 'id')
 * @method static Vacature|Proxy last(string $sortedField = 'id')
 * @method static Vacature|Proxy random(array $attributes = [])
 * @method static Vacature|Proxy randomOrCreate(array $attributes = [])
 * @method static Vacature[]|Proxy[] all()
 * @method static Vacature[]|Proxy[] findBy(array $attributes)
 * @method static Vacature[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Vacature[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static VacatureRepository|RepositoryProxy repository()
 * @method Vacature|Proxy create($attributes = [])
 */
final class VacatureFactory extends ModelFactory
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
            // ->afterInstantiate(function(Vacature $vacature) {})
        ;
    }

    protected static function getClass(): string
    {
        return Vacature::class;
    }
}

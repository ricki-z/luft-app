<?php declare(strict_types=1);

namespace App\Geocoding\Guesser;

use Geocoder\Provider\Provider;

abstract class AbstractGuesser
{
    public function __construct(protected Provider $provider)
    {
    }
}

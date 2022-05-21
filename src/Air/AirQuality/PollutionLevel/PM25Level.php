<?php declare(strict_types=1);

namespace App\Air\AirQuality\PollutionLevel;

class PM25Level extends AbstractPollutionLevel
{
    protected array $levels = [10, 20, 35, 50, 100];
}

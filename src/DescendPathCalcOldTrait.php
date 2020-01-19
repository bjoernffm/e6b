<?php

namespace bjoernffm\e6b;

use InvalidArgumentException;

trait DescendPathCalcOldTrait
{
    public static function getPathByDescendRate($ias, $descentRate, $initialAltitude, $targetAltitude)
    {
        $ias = (int) $ias;
        $descentRate = (int) $descentRate;
        $initialAltitude = (int) $initialAltitude;
        $targetAltitude = (int) $targetAltitude;

        if ($ias <= 0) {
            throw new InvalidArgumentException('Parameter $ias needs to be greater than 0');
        }

        if ($descentRate <= 0) {
            throw new InvalidArgumentException('Parameter $descentRate needs to be greater than 0');
        }

        if ($initialAltitude <= $targetAltitude) {
            throw new InvalidArgumentException('Parameter $initialAltitude needs to be greater than $targetAltitude');
        }

        $rate = 1; //minutes

        $descendTime = ($initialAltitude - $targetAltitude) / $descentRate;

        $result = [
            [
                'nauticalMiles' => (float) 0,
                'altitude'      => (float) round($initialAltitude, 2),
                'minutes'       => (float) 0,
            ],
        ];

        $distanceTotal = 0;
        for ($i = 1; $i <= floor($descendTime); $i++) {
            $highAltitude = $initialAltitude - (($i - 1) * $descentRate * $rate);
            $lowAltitude = $initialAltitude - ($i * $descentRate * $rate);
            $highTAS = self::getTAS($ias, $highAltitude);
            $lowTAS = self::getTAS($ias, $lowAltitude);
            $distance = (($highTAS + $lowTAS) / 2) * ($rate / 60);
            $distanceTotal += $distance;

            $result[] = [
                'nauticalMiles' => (float) round($distanceTotal, 2),
                'altitude'      => (float) round($lowAltitude, 2),
                'minutes'       => (float) $i,
            ];
        }

        $rest = $descendTime - floor($descendTime);

        if ($rest != 0) {
            $highAltitude = $initialAltitude - (($i - 1) * $descentRate * $rate);
            $lowAltitude = $initialAltitude - ($descendTime * $descentRate * $rate);
            $highTAS = self::getTAS($ias, $highAltitude);
            $lowTAS = self::getTAS($ias, $lowAltitude);
            $distance = (($highTAS + $lowTAS * $rest) / 2) * ($rate / 60);
            $distanceTotal += $distance;

            $result[] = [
                'nauticalMiles' => (float) round($distanceTotal, 2),
                'altitude'      => (float) round($lowAltitude, 2),
                'minutes'       => (float) round($descendTime, 2),
            ];
        }

        return [
            'nauticalMiles' => (float) round($distanceTotal, 2),
            'minutes'       => (float) round($descendTime, 2),
            'path'          => $result,
        ];
    }
}

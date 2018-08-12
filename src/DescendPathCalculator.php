<?php

namespace bjoernffm\e6b;

use \InvalidArgumentException;

class DescendPathCalculator extends Calculator
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

        $descendTime = ($initialAltitude-$targetAltitude)/$descentRate;

        $result = [
            [
                'nauticalMiles' => (double) 0,
                'altitude' => (double) round($initialAltitude, 2),
                'minutes' => (double) 0
            ]
        ];

        $distanceTotal = 0;
        for ($i = 1; $i <= floor($descendTime); $i++) {
            $highAltitude = $initialAltitude - (($i-1)*$descentRate*$rate);
            $lowAltitude = $initialAltitude - ($i*$descentRate*$rate);
            $highTAS = self::getTAS($ias, $highAltitude);
            $lowTAS = self::getTAS($ias, $lowAltitude);
            $distance = (($highTAS+$lowTAS)/2)*($rate/60);
            $distanceTotal += $distance;

            $result[] = [
                'nauticalMiles' => (double) round($distanceTotal, 2),
                'altitude' => (double) round($lowAltitude, 2),
                'minutes' => (double) $i
            ];
        }

        $rest = $descendTime-floor($descendTime);

        if ($rest != 0) {
            $highAltitude = $initialAltitude - (($i-1)*$descentRate*$rate);
            $lowAltitude = $initialAltitude - ($descendTime*$descentRate*$rate);
            $highTAS = self::getTAS($ias, $highAltitude);
            $lowTAS = self::getTAS($ias, $lowAltitude);
            $distance = (($highTAS+$lowTAS*$rest)/2)*($rate/60);
            $distanceTotal += $distance;

            $result[] = [
                'nauticalMiles' => (double) round($distanceTotal, 2),
                'altitude' => (double) round($lowAltitude, 2),
                'minutes' => (double) round($descendTime, 2)
            ];
        }

        return [
            'nauticalMiles' => (double) round($distanceTotal, 2),
            'minutes' => (double) round($descendTime, 2),
            'path' => $result
        ];
    }
}

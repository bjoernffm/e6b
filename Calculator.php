<?php

namespace e6b;

class Calculator
{
    public static function getWindCorrectionAngle($course, $trueAirspeed, $windDirection, $windSpeed)
    {
        $course = deg2rad($course);
        $windDirection = deg2rad($windDirection);

        $wca = asin(($windSpeed * sin($windDirection-$course)) / $trueAirspeed);
        //$wca = rad2deg($wca);

        $gs =
            sqrt(
                pow($trueAirspeed, 2) +
                pow($windSpeed, 2) -
                (
                    2 * $trueAirspeed * $windSpeed *
                    cos($course - $windDirection + $wca)
                )
            );

        return [
            'windCorrectionAngle' => (int) round(rad2deg($wca)),
            'heading' => (int) round(rad2deg($course + $wca)),
            'groundSpeed' => (int) round($gs)
        ];
    }

    public static function getFlightTime($distance, $groundSpeed)
    {
        $minutes = ($distance / $groundSpeed) * 60;

        $formattedMinutes = round($minutes) % 60;
        if ($formattedMinutes < 10) {
            $formattedMinutes = '0'.$formattedMinutes;
        }

        $formattedHours = floor($minutes / 60);
        if ($formattedHours < 10) {
            $formattedHours = '0'.$formattedHours;
        }

        $formatted = $formattedHours . ':' . $formattedMinutes;

        return [
            'minutes' => (int) round($minutes),
            'formatted' => $formatted
        ];
    }

    public static function getTrueAirspeed($distance, $groundSpeed)
    {
        $minutes = ($distance / $groundSpeed) * 60;

        $formattedMinutes = round($minutes) % 60;
        if ($formattedMinutes < 10) {
            $formattedMinutes = '0'.$formattedMinutes;
        }

        $formattedHours = floor($minutes / 60);
        if ($formattedHours < 10) {
            $formattedHours = '0'.$formattedHours;
        }

        $formatted = $formattedHours . ':' . $formattedMinutes;

        return [
            'minutes' => (int) round($minutes),
            'formatted' => $formatted
        ];
    }

    public static function convertKnots($knots)
    {
        return [
            'kph' => (int) round($knots * 1.8519999999990517760000004854907),
            'mph' => (int) round($knots * 1.1507794480230762918306396607921),
        ];
    }

    public static function convertKilometersPerHour($kph)
    {
        return [
            'knots' => (int) round($kph * 0.539956803456),
            'mph' => (int) round($kph * 0.621371192237),
        ];
    }

    public static function convertMilesPerHour($mph)
    {
        return [
            'knots' => (int) round($mph * 0.868976241901),
            'kph' => (int) round($mph * 1.609344),
        ];
    }

    public static function convertFeet($ft)
    {
        return [
            'meters' => (int) round($ft * 0.3048)
        ];
    }
}

$ret = Calculator::convertFeet(37000);
var_dump($ret);
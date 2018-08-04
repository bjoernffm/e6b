<?php

namespace bjoernffm\e6b;

use \Exception;

class Calculator
{
    public static function getWindCorrectionAngle($course, $trueAirspeed, $windDirection, $windSpeed)
    {
        $course = deg2rad($course % 360);
        $windDirection = deg2rad($windDirection % 360);

        $wca = asin(($windSpeed * sin($windDirection-$course)) / $trueAirspeed);

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

    public static function getWindcomponents($trueCourse, $windDirection, $windSpeed)
    {
        $trueCourse = deg2rad($trueCourse % 360);
        $windDirection = deg2rad($windDirection % 360);
        $angle = abs($trueCourse-$windDirection);

        $headwind = (int) abs(round(cos($angle)*$windSpeed));
        $crosswind = (int) abs(round(sin($angle)*$windSpeed));

        if ($angle > (M_PI/2) and  $angle < (M_PI+(M_PI/2))) {
            $headwind = 0;
        }

        return [
            'headwind' => $headwind,
            'crosswind' => $crosswind
        ];
    }

    public static function getTAS($IAS, $altitude = 0, $QNH = 1013.25, $temperature = 15)
    {
        $lapseRate = 0.0019812;		// degrees / foot std. lapse rate C° in to K° result
        $temperatureCorrection = 273.15;			// deg Kelvin
        $standardTemperature0 = 288.15;			// deg Kelvin

        $xx = $QNH / 1013.25;
        $pressureAltitude = $altitude + 145442.2 * (1 - pow($xx, 0.190261));

        $standardTemperature = $standardTemperature0 - $pressureAltitude * $lapseRate;

        $temperatureRatio = $standardTemperature / $lapseRate;
        $xx = $standardTemperature /($temperature + $temperatureCorrection);	// for temp in deg C
        $densityAltitude = $pressureAltitude + $temperatureRatio * (1 - pow($xx, 0.234969));

        $a = $densityAltitude * $lapseRate;			// Calculate DA temperature
        $b = $standardTemperature0 - $a;				// Correct DA temp to Kelvin
        $c = $b / $standardTemperature0;				// Temperature ratio
        $c1 = 1 / 0.234969;				// Used to find .235 root next
        $d = pow($c, $c1);			// Establishes Density Ratio
        $d = pow($d, .5);			// For TAS, square root of DR
        $e = 1 / $d;					// For TAS; 1 divided by above
        $TAS = $e * $IAS;

        return round($TAS);
    }

    public static function getFlightTime($distance, $groundSpeed)
    {
        if ($distance == 0 and $groundSpeed == 0) {
            return [
                'minutes' => 0,
                'formatted' => '00:00'
            ];
        }

        if ($groundSpeed <= 0) {
            return [
                'minutes' => INF,
                'formatted' => '--:--'
            ];
        }

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

    /**
     * Formats supported:
     * 40.446° -79.982°
     * 40.446° N 79.982° W
     * 40° 26.767′ N 79° 58.933′ W
     * 40° 26' 46" N 79° 58' 56" E
     */
    public static function convertLatLonToDecimalDegrees($latlon)
    {
        $latlon = trim($latlon);

        // format 40.446 -79.982
        preg_match('#\A(-?)(\d+\.\d+)\s+(-?)(\d+\.\d+)#', $latlon, $matches);
        if (count($matches) == 5) {
            $lat = abs($matches[2]);
            $lon = abs($matches[4]);

            if (strtolower($matches[1]) == '-') {
                $lat *= -1;
            }

            if (strtolower($matches[3]) == '-') {
                $lon *= -1;
            }

            return [
                'lat' => $lat,
                'lon' => $lon
            ];
        }

        // format 40.446° N 79.982° W
        preg_match('#\A(\d{1,2}\.\d+)\D*([ns])\D*(\d{1,3}\.\d+)\D*([woe])#i', $latlon, $matches);
        if (count($matches) == 5) {
            $lat = abs($matches[1]);
            $lon = abs($matches[3]);

            if (strtolower($matches[2]) == 's') {
                $lat *= -1;
            }

            if (strtolower($matches[4]) == 'w') {
                $lon *= -1;
            }

            return [
                'lat' => $lat,
                'lon' => $lon
            ];
        }

        // format 40° 26.767′ N 79° 58.933′ W
        preg_match('#\A(\d{1,2})\D+(\d{1,2}\.\d+)\D*([ns])\D*(\d{1,3})\D+(\d{1,2}\.\d+)\D*([woe])#i', $latlon, $matches);
        if (count($matches) == 7) {
            $lat = abs($matches[1] + ($matches[2]/60));
            $lon = abs($matches[4] + ($matches[5]/60));

            if (strtolower($matches[3]) == 's') {
                $lat *= -1;
            }

            if (strtolower($matches[6]) == 'w') {
                $lon *= -1;
            }

            return [
                'lat' => $lat,
                'lon' => $lon
            ];
        }

        // format 40° 26' 46" N 79° 58' 56" E
        preg_match('#\A(\d{1,2})\D+(\d{1,2})\D+(\d{1,2})["]?\s*([ns])\D+(\d{1,3})\D+(\d{1,2})\D+(\d{1,2})["]?\s*([woe])#i', $latlon, $matches);
        if (count($matches) == 9) {
            $lat = abs($matches[1] + ($matches[2]/60) + ($matches[3]/3600));
            $lon = abs($matches[5] + ($matches[6]/60) + ($matches[7]/3600));

            if (strtolower($matches[4]) == 's') {
                $lat *= -1;
            }

            if (strtolower($matches[8]) == 'w') {
                $lon *= -1;
            }

            return [
                'lat' => $lat,
                'lon' => $lon
            ];
        }

        throw new Exception('String "'.$latlon.'" could not be parsed.');
    }
}

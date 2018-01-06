<?php

namespace bjoernffm\e6b;

class Coordinate
{
    protected $lat = null;
    protected $lon = null;
    
    public function __construct($point)
    {
        $lat = null;
        $lon = null;
        
        if(
            preg_match(
                '#\s*(\d{1,2})°\s+(\d{1,2})\'\s+(\d{1,2})"\s+([NS])\s+(\d{1,3})°\s+(\d{1,2})\'\s+(\d{1,2})"\s+([OEW])\s*#',
                strtoupper($point),
                $matches
            ) == 1
        ) {
            $lat = (double) ($matches[1]+(($matches[2]*60)+$matches[3])/3600); 
            $lon = (double) ($matches[5]+(($matches[6]*60)+$matches[7])/3600);
            
            if ($matches[4] == 'S') {
                $lat *= -1;    
            }
            if ($matches[8] == 'W') {
                $lon *= -1;    
            }
        } elseif(
            preg_match(
                '#\s*([NS])\s+(\d{1,2})°\s+(\d{1,2}[,\.]\d+)\'\s+([OEW])\s+(\d{1,3})°\s+(\d{1,3}[,\.]\d+)\'\s*#',
                strtoupper($point),
                $matches
            ) == 1
        ) {
            $matches[2] = (double) $matches[2];
            $matches[3] = (double) str_replace(',', '.', $matches[3]);
            $matches[5] = (double) $matches[5];
            $matches[6] = (double) str_replace(',', '.', $matches[6]);
            
            $lat = (double) ($matches[2]+($matches[3]/60)); 
            $lon = (double) ($matches[5]+($matches[6]/60));
            
            if ($matches[1] == 'S') {
                $lat *= -1;    
            }
            if ($matches[4] == 'W') {
                $lon *= -1;    
            }
        } elseif(
            preg_match(
                '#\s*([\+\-]{0,1}\d{1,2}[,\.]\d+),([\+\-]{0,1}\d{1,3}[,\.]\d+)\s*#',
                strtoupper($point),
                $matches
            ) == 1
        ) {
            
            $lat = (double) str_replace(',', '.', $matches[1]);
            $lon = (double) str_replace(',', '.', $matches[2]);
        }
        
        var_dump($lat);
        var_dump($lon);
        
        $this->lat = $lat;
        $this->lon = $lon;
    }
    
    public function getLatitude()
    {
        return $this->lat;
    }
    
    public function getLongitude()
    {
        return $this->lon;
    }
    
    public function format($type = 'degrees minutes seconds')
    {
        if ($this->lat >= 0) {
            $latDirection = 'N';
        } else {
            $latDirection = 'S';
        }
        
        $lat = abs($this->lat);
        $latDegrees = floor($lat);
        $latMinutes = floor(($lat-$latDegrees)*60);
        $latSeconds = round(3600*($lat-$latDegrees)-60*$latMinutes);
        
        $lat = $latDegrees.'° '.$latMinutes.'\' '.$latSeconds.'" '.$latDirection;
        
        if ($this->lon >= 0) {
            $lonDirection = 'E';
        } else {
            $lonDirection = 'W';
        }
        
        $lon = abs($this->lon);
        $lonDegrees = floor($lon);
        $lonMinutes = floor(($lon-$lonDegrees)*60);
        $lonSeconds = round(3600*($lon-$lonDegrees)-60*$lonMinutes);
        
        $lon = $lonDegrees.'° '.$lonMinutes.'\' '.$lonSeconds.'" '.$lonDirection;
        
        $result = $lat . ' ' . $lon;
        
        var_dump($result);
    }
}

$co = new Coordinate('-64.2405643,-56.6313201');
$co->format();
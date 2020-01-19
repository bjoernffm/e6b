<?php

namespace bjoernffm\e6b;

use InvalidArgumentException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DescendPathCalculator extends Calculator
{
    use DescendPathCalcOldTrait;

    protected $options;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);

        if ($this->options['descendKIAS'] <= 0) {
            throw new InvalidArgumentException('Parameter descendKIAS needs to be greater than 0');
        }

        if ($this->options['descendRate'] <= 0) {
            throw new InvalidArgumentException('Parameter descendRate needs to be greater than 0');
        }

        if ($this->options['initialAltitude'] <= $this->options['targetAltitude']) {
            throw new InvalidArgumentException('Parameter initialAltitude needs to be greater than targetAltitude');
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'initialAltitude'       => null,
            'targetAltitude'   => null,
            'transitionLevel'   => 180,
            'qnh'       => 1013,
            'descendMach' => null,
            'descendKIAS' => 270,
            'descendRate' => 1800,
            'reduce' => true
        ]);

        $resolver->isRequired('initialAltitude');
        $resolver->isRequired('targetAltitude');
        $resolver->isRequired('targetKIAS');

        $resolver->setAllowedTypes('initialAltitude', 'int');
        $resolver->setAllowedTypes('targetAltitude', 'int');
        $resolver->setAllowedTypes('transitionLevel', 'int');
        $resolver->setAllowedTypes('qnh', 'int');
        $resolver->setAllowedTypes('descendMach', 'double');
        $resolver->setAllowedTypes('descendKIAS', 'int');
        $resolver->setAllowedTypes('reduce', 'bool');
    }

    public function run()
    {
        $secondInterval = 60;
        $secondsElapsed = 0;

        $altitude = $this->options['initialAltitude'];
        $distanceTotal = 0;

        $data = [];
        $summary = [];

        while(true) {
            $table = new IsaTable();
            $result = $table->getDataByField('altitudeInFeet', $altitude);

            $stamp = round($secondsElapsed/60).'min/'.round($distanceTotal).'nm';

            if ($altitude > $this->options['transitionLevel']*100) {
                $altitudeFormatted = round($altitude/1000);
                $altitudeFormatted *= 10;

                if ($altitudeFormatted < 100) {
                    $altitudeFormatted = '0'.$altitudeFormatted;
                }
                $altitudeFormatted = 'FL'.$altitudeFormatted;

                $qnh = 1013.25;
            } else {
                if ($qnh != $this->options['qnh']) {
                    $tmpFl = $this->options['transitionLevel'];
                    if ($tmpFl < 100) {
                        $tmpFl = '0'.$tmpFl;
                    }
                    $summary[] = 'After '.$stamp.', passing FL'.$tmpFl.', set QNH '.$this->options['qnh'];

                    $diff = $this->options['qnh']-$qnh;
                    $diff *= 30;
                    $altitude = $altitude+$diff;
                }
                $altitudeFormatted = (round($altitude/100)*100).'ft';
                $qnh = $this->options['qnh'];
            }

            if ($altitude <= 10000 and $this->options['reduce'] == true) {
                if ($mode != 'reduced_kias') {
                    if ($this->options['transitionLevel'] < 100) {
                        $summary[] = 'After '.$stamp.', reduce to 240KIAS below FL100';
                    } else {
                        $summary[] = 'After '.$stamp.', reduce to 240KIAS below 10000ft';
                    }
                }
                $kias = 240;
                $ktas = Calculator::getTAS($kias, $altitude);
                $mach = null;
                $mode = 'reduced_kias';
            } else {
                $kias = $this->options['descendKIAS'];
                $ktas = Calculator::getTAS($kias, $altitude);
                $mach = $ktas/($result['speedOfSound']*1.94384);

                if ($mach > $this->options['descendMach']) {
                    $mach = $this->options['descendMach'];
                    $kias = $this->options['descendMach']*$result['speedOfSound'];
                    $ktas = Calculator::getTAS($kias, $altitude);
                    $mode = 'mach';
                } else {
                    // if the value previously was mach
                    if ($mode == 'mach') {
                        $summary[] = 'After '.$stamp.', switch from mach mode to '.$kias.'KIAS at '.$altitudeFormatted;
                    }
                    $mode = 'kias';
                }
            }

            if ($mode == 'mach') {
                $speedFormatted = 'Mach '.round($mach, 3);
            } else {
                $speedFormatted = $kias.'KIAS';
            }

            if (count($summary) == 0) {
                $summary[] = 'Start at '.$altitudeFormatted.' with '.$speedFormatted.' and descend rate of '.$this->options['descendRate'].'ft/min';
            }

            $distance = $ktas*($secondInterval/3600);
            $distanceTotal += $distance;

            $data[] = [
                'elapsedTime' => round($secondsElapsed/60),
                'distance' => $distance,
                'distanceTotal' => $distanceTotal,
                'altitude' => $altitude,
                'ias' => $kias,
                'tas' => $ktas,
                'mach' => $mach,
                'qnh' => $qnh,
                'mode' => $mode
            ];

            $altitude -= $this->options['descendRate']*($secondInterval/60);
            $secondsElapsed += $secondInterval;

            if ($altitude <= $this->options['targetAltitude']) {
                $summary[] = 'Reaching '.$altitudeFormatted.' at '.$stamp;
                break;
            }
        }

        #var_dump($summary);
        foreach($data as $items) {
            #echo '['.$items['distanceTotal'].','.$items['altitude'].'],';
        }
        print_r($data);
    }
}

<?php

use bjoernffm\e6b\Calculator as e6bCalc;

require_once __DIR__ . '/vendor/autoload.php';

$result = e6bCalc::getWindCorrectionAngle(220, 110, 270, 25);
var_dump($result);
# E6-B Calculator Emulation

[![Build Status](https://travis-ci.org/bjoernffm/e6b.svg?branch=master)](https://travis-ci.org/bjoernffm/e6b)
[![StyleCI](https://github.styleci.io/repos/94612899/shield?style=flat&branch=master)](https://github.styleci.io/repos/94612899)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e7f7433410bc4412b8799a087aa13e74)](https://www.codacy.com/manual/bjoernffm/e6b)

This class provides a first and very basic version of an ordinary E6-B flight computer also nicknamed the "whiz wheel".

An E6-B calculator is a form of circular slide rule used in aviation and one of a very few analog computers in widespread use in the 21st century.

## Usage

Imagine we want to fly a course of 220 degrees having a true airspeed of 110 kts. Wind comes from a direction of 270 degrees with a speed of 25 kts. So what's the resulting angle of correction, heading and groundspeed?

```php
<?php

use bjoernffm\e6b\Calculator as e6bCalc;

require_once __DIR__ . '/vendor/autoload.php';

$result = e6bCalc::getWindCorrectionAngle(220, 110, 270, 25);
var_dump($result);

/*
array(3) {
  'windCorrectionAngle' =>
  int(10)
  'heading' =>
  int(230)
  'groundSpeed' =>
  int(92)
}
*/
```

Have fun using the E6-B emulation!

<?php

namespace bjoernffm\e6b;

use \InvalidArgumentException;

class IsaTable extends DataTable
{
    public $data = [
        [
            'altitudeInMeters' => -2000,
            'altitudeInFeet' => -6560,
            'temperatureInKelvin' => 301.2,
            'pressureInMillibar' => 1277.8,
            'relativeDensity' => 1.2067,
            'speedOfSound' => 347.9
        ],
        [
            'altitudeInMeters' => -1500,
            'altitudeInFeet' => -4920,
            'temperatureInKelvin' => 297.9,
            'pressureInMillibar' => 1207.0,
            'relativeDensity' => 1.1522,
            'speedOfSound' => 346.0
        ],
        [
            'altitudeInMeters' => -1000,
            'altitudeInFeet' => -3280,
            'temperatureInKelvin' => 294.7,
            'pressureInMillibar' => 1139.3,
            'relativeDensity' => 1.0996,
            'speedOfSound' => 344.1
        ],
        [
            'altitudeInMeters' => -500,
            'altitudeInFeet' => -1640,
            'temperatureInKelvin' => 291.4,
            'pressureInMillibar' => 1074.8,
            'relativeDensity' => 1.0489,
            'speedOfSound' => 342.2
        ],
        [
            'altitudeInMeters' => 0,
            'altitudeInFeet' => 0,
            'temperatureInKelvin' => 288.15,
            'pressureInMillibar' => 1013.25,
            'relativeDensity' => 1.0000,
            'speedOfSound' => 340.3
        ],
        [
            'altitudeInMeters' => 500,
            'altitudeInFeet' => 1640,
            'temperatureInKelvin' => 284.9,
            'pressureInMillibar' => 954.6,
            'relativeDensity' => 0.9529,
            'speedOfSound' => 338.4
        ],
        [
            'altitudeInMeters' => 1000,
            'altitudeInFeet' => 3280,
            'temperatureInKelvin' => 281.7,
            'pressureInMillibar' => 898.8,
            'relativeDensity' => 0.9075,
            'speedOfSound' => 336.4
        ],
        [
            'altitudeInMeters' => 1500,
            'altitudeInFeet' => 4920,
            'temperatureInKelvin' => 278.4,
            'pressureInMillibar' => 845.6,
            'relativeDensity' => 0.8638,
            'speedOfSound' => 334.5
        ],
        [
            'altitudeInMeters' => 2000,
            'altitudeInFeet' => 6560,
            'temperatureInKelvin' => 275.2,
            'pressureInMillibar' => 795,
            'relativeDensity' => 0.8217,
            'speedOfSound' => 332.5
        ],
        [
            'altitudeInMeters' => 2500,
            'altitudeInFeet' => 8200,
            'temperatureInKelvin' => 271.9,
            'pressureInMillibar' => 746.9,
            'relativeDensity' => 0.7812,
            'speedOfSound' => 330.6
        ],
        [
            'altitudeInMeters' => 3000,
            'altitudeInFeet' => 9840,
            'temperatureInKelvin' => 268.7,
            'pressureInMillibar' => 701.2,
            'relativeDensity' => 0.7423,
            'speedOfSound' => 328.6
        ],
        [
            'altitudeInMeters' => 3500,
            'altitudeInFeet' => 11480,
            'temperatureInKelvin' => 265.4,
            'pressureInMillibar' => 657.8,
            'relativeDensity' => 0.7048,
            'speedOfSound' => 326.6
        ],
        [
            'altitudeInMeters' => 4000,
            'altitudeInFeet' => 13120,
            'temperatureInKelvin' => 262.2,
            'pressureInMillibar' => 616.6,
            'relativeDensity' => 0.6689,
            'speedOfSound' => 324.6
        ],
        [
            'altitudeInMeters' => 4500,
            'altitudeInFeet' => 14760,
            'temperatureInKelvin' => 258.9,
            'pressureInMillibar' => 577.5,
            'relativeDensity' => 0.6343,
            'speedOfSound' => 322.6
        ],
        [
            'altitudeInMeters' => 5000,
            'altitudeInFeet' => 16400,
            'temperatureInKelvin' => 255.7,
            'pressureInMillibar' => 540.5,
            'relativeDensity' => 0.6012,
            'speedOfSound' => 320.5
        ],
        [
            'altitudeInMeters' => 5500,
            'altitudeInFeet' => 18040,
            'temperatureInKelvin' => 252.4,
            'pressureInMillibar' => 505.4,
            'relativeDensity' => 0.5694,
            'speedOfSound' => 318.5
        ],
        [
            'altitudeInMeters' => 6000,
            'altitudeInFeet' => 19680,
            'temperatureInKelvin' => 249.2,
            'pressureInMillibar' => 472.2,
            'relativeDensity' => 0.5389,
            'speedOfSound' => 316.5
        ],
        [
            'altitudeInMeters' => 6500,
            'altitudeInFeet' => 21320,
            'temperatureInKelvin' => 245.9,
            'pressureInMillibar' => 440.8,
            'relativeDensity' => 0.5096,
            'speedOfSound' => 314.4
        ],
        [
            'altitudeInMeters' => 7000,
            'altitudeInFeet' => 22960,
            'temperatureInKelvin' => 242.7,
            'pressureInMillibar' => 411.1,
            'relativeDensity' => 0.4817,
            'speedOfSound' => 312.3
        ],
        [
            'altitudeInMeters' => 7500,
            'altitudeInFeet' => 24600,
            'temperatureInKelvin' => 239.5,
            'pressureInMillibar' => 383,
            'relativeDensity' => 0.4549,
            'speedOfSound' => 310.2
        ],
        [
            'altitudeInMeters' => 8000,
            'altitudeInFeet' => 26240,
            'temperatureInKelvin' => 236.2,
            'pressureInMillibar' => 356.5,
            'relativeDensity' => 0.4292,
            'speedOfSound' => 308.1
        ],
        [
            'altitudeInMeters' => 8500,
            'altitudeInFeet' => 27880,
            'temperatureInKelvin' => 233,
            'pressureInMillibar' => 331.5,
            'relativeDensity' => 0.4047,
            'speedOfSound' => 306
        ],
        [
            'altitudeInMeters' => 9000,
            'altitudeInFeet' => 29520,
            'temperatureInKelvin' => 229.7,
            'pressureInMillibar' => 308,
            'relativeDensity' => 0.3813,
            'speedOfSound' => 303.8
        ],
        [
            'altitudeInMeters' => 9500,
            'altitudeInFeet' => 31160,
            'temperatureInKelvin' => 226.5,
            'pressureInMillibar' => 285.8,
            'relativeDensity' => 0.3589,
            'speedOfSound' => 301.7
        ],
        [
            'altitudeInMeters' => 10000,
            'altitudeInFeet' => 32800,
            'temperatureInKelvin' => 223.3,
            'pressureInMillibar' => 265,
            'relativeDensity' => 0.3376,
            'speedOfSound' => 299.8
        ],
        [
            'altitudeInMeters' => 10500,
            'altitudeInFeet' => 34440,
            'temperatureInKelvin' => 220,
            'pressureInMillibar' => 245.4,
            'relativeDensity' => 0.3172,
            'speedOfSound' => 297.4
        ],
        [
            'altitudeInMeters' => 11000,
            'altitudeInFeet' => 36080,
            'temperatureInKelvin' => 216.8,
            'pressureInMillibar' => 227,
            'relativeDensity' => 0.2978,
            'speedOfSound' => 295.2
        ],
        [
            'altitudeInMeters' => 11500,
            'altitudeInFeet' => 37720,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 209.8,
            'relativeDensity' => 0.2755,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 12000,
            'altitudeInFeet' => 39360,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 194,
            'relativeDensity' => 0.2546,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 12500,
            'altitudeInFeet' => 41000,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 179.3,
            'relativeDensity' => 0.2354,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 13000,
            'altitudeInFeet' => 42640,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 165.8,
            'relativeDensity' => 0.2176,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 13500,
            'altitudeInFeet' => 44280,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 153.3,
            'relativeDensity' => 0.2012,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 14000,
            'altitudeInFeet' => 45920,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 141.7,
            'relativeDensity' => 0.186,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 14500,
            'altitudeInFeet' => 47560,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 131,
            'relativeDensity' => 0.172,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 15000,
            'altitudeInFeet' => 49200,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 121.1,
            'relativeDensity' => 0.159,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 15500,
            'altitudeInFeet' => 50840,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 112,
            'relativeDensity' => 0.147,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 16000,
            'altitudeInFeet' => 52480,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 103.5,
            'relativeDensity' => 0.1359,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 16500,
            'altitudeInFeet' => 54120,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 95.72,
            'relativeDensity' => 0.1256,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 17000,
            'altitudeInFeet' => 55760,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 88.5,
            'relativeDensity' => 0.1162,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 17500,
            'altitudeInFeet' => 57400,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 81.82,
            'relativeDensity' => 0.1074,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 18000,
            'altitudeInFeet' => 59040,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 75.65,
            'relativeDensity' => 0.0993,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 18500,
            'altitudeInFeet' => 60680,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 69.95,
            'relativeDensity' => 0.09182,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 19000,
            'altitudeInFeet' => 62320,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 64.67,
            'relativeDensity' => 0.08489,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 19500,
            'altitudeInFeet' => 63960,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 59.8,
            'relativeDensity' => 0.0785,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 20000,
            'altitudeInFeet' => 65600,
            'temperatureInKelvin' => 216.7,
            'pressureInMillibar' => 55.29,
            'relativeDensity' => 0.07258,
            'speedOfSound' => 295.1
        ],
        [
            'altitudeInMeters' => 22000,
            'altitudeInFeet' => 72160,
            'temperatureInKelvin' => 218.6,
            'pressureInMillibar' => 40.47,
            'relativeDensity' => 0.05266,
            'speedOfSound' => 296.4
        ],
        [
            'altitudeInMeters' => 24000,
            'altitudeInFeet' => 78720,
            'temperatureInKelvin' => 220.6,
            'pressureInMillibar' => 29.72,
            'relativeDensity' => 0.03832,
            'speedOfSound' => 297.7
        ],
        [
            'altitudeInMeters' => 26000,
            'altitudeInFeet' => 85280,
            'temperatureInKelvin' => 222.5,
            'pressureInMillibar' => 21.88,
            'relativeDensity' => 0.02797,
            'speedOfSound' => 299.1
        ],
        [
            'altitudeInMeters' => 28000,
            'altitudeInFeet' => 91840,
            'temperatureInKelvin' => 224.5,
            'pressureInMillibar' => 16.16,
            'relativeDensity' => 0.02047,
            'speedOfSound' => 300.4
        ],
        [
            'altitudeInMeters' => 30000,
            'altitudeInFeet' => 98400,
            'temperatureInKelvin' => 226.5,
            'pressureInMillibar' => 11.97,
            'relativeDensity' => 0.01503,
            'speedOfSound' => 301.7
        ]
    ];
}
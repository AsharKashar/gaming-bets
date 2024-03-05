<?php


namespace App\Service;

class FortnitePrizePoolService
{
    protected static array $soloBands = [
        '2.5' => [
            '100' => [94,185],
            '200' => [186,371],
            '400' => [372,557],
            '600' => [558,742],
            '800' => [743,928],
            '1000' => [929,1113],
            '1200' => [1114,1298],
            '1400' => [1299,2781],
            '3000' => [2782,4632],
            '5000' => [4633,9258],
            '10000' => [9269,null],
        ],
        '5' => [
            '100' => [94,186],
            '200' => [187,373],
            '400' => [374,560],
            '600' => [561,746],
            '800' => [747,933],
            '1000' => [934,1120],
            '1200' => [1121,1306],
            '1400' => [1307,2797],
            '3000' => [2798,4660],
            '5000' => [4661,9113],
            '10000' => [9314,null],
        ],
        '7.5' => [
            '100' => [94,187],
            '200' => [188,374],
            '400' => [375,561],
            '600' => [562,748],
            '800' => [749,935],
            '1000' => [936,1123],
            '1200' => [1124,1310],
            '1400' => [1311,2805],
            '3000' => [2806,4673],
            '5000' => [4674,9339],
            '10000' => [9340,null],
        ],
        '10' => [
            '100' => [94,187],
            '200' => [188,375],
            '400' => [376,562],
            '600' => [563,750],
            '800' => [751,937],
            '1000' => [938,1124],
            '1200' => [1125,1312],
            '1400' => [1313,2810],
            '3000' => [2811,4681],
            '5000' => [4682,9356],
            '10000' => [9357,null],
        ],
        '15' => [
            '100' => [95,188],
            '200' => [189,376],
            '400' => [377,564],
            '600' => [565,752],
            '800' => [753,939],
            '1000' => [940,1127],
            '1200' => [1128,1315],
            '1400' => [1316,2817],
            '3000' => [2818,4693],
            '5000' => [4694,9380],
            '10000' => [9381,null],
        ],
        '20' => [
            '100' => [95,188],
            '200' => [189,376],
            '400' => [377,565],
            '600' => [566,753],
            '800' => [754,941],
            '1000' => [942,1129],
            '1200' => [1130,1317],
            '1400' => [1318,2821],
            '3000' => [2822,4701],
            '5000' => [4702,9396],
            '10000' => [9397,null],
        ],
        '25' => [
            '100' => [95,188],
            '200' => [189,377],
            '400' => [378,565],
            '600' => [566,754],
            '800' => [755,942],
            '1000' => [943,1130],
            '1200' => [1131,1319],
            '1400' => [1320,2825],
            '3000' => [2826,4706],
            '5000' => [4707,9407],
            '10000' => [9408,null],
        ],
    ];
    protected static array $duoBands = [
        '2.5' => [
            '100' => [94,184],
            '200' => [186,370],
            '400' => [372,556],
            '600' => [558,742],
            '800' => [744,928],
            '1000' => [930,1112],
            '1200' => [1114,1298],
            '1400' => [1300,2780],
            '3000' => [2782,4632],
            '5000' => [4634,9258],
            '10000' => [9260,null],
        ],
        '5' => [
            '100' => [94,186],
            '200' => [188,372],
            '400' => [374,560],
            '600' => [562,746],
            '800' => [748,932],
            '1000' => [934,1120],
            '1200' => [1122,1306],
            '1400' => [1308,2796],
            '3000' => [2798,4660],
            '5000' => [4662,9312],
            '10000' => [9314,null],
        ],
        '7.5' => [
            '100' => [94,186],
            '200' => [188,374],
            '400' => [376,560],
            '600' => [562,748],
            '800' => [750,934],
            '1000' => [936,1122],
            '1200' => [1124,1310],
            '1400' => [1312,2804],
            '3000' => [2806,4672],
            '5000' => [4674,9338],
            '10000' => [9340,null],
        ],
        '10' => [
            '100' => [94,186],
            '200' => [188,374],
            '400' => [376,562],
            '600' => [564,750],
            '800' => [752,936],
            '1000' => [938,1124],
            '1200' => [1126,1312],
            '1400' => [1314,2810],
            '3000' => [2812,4680],
            '5000' => [4682,9356],
            '10000' => [9358,null],
        ],
        '15' => [
            '100' => [96,188],
            '200' => [190,376],
            '400' => [378,564],
            '600' => [566,752],
            '800' => [754,938],
            '1000' => [940,1126],
            '1200' => [1128,1314],
            '1400' => [1316,2816],
            '3000' => [2818,4692],
            '5000' => [4694,9380],
            '10000' => [9382,null],
        ],
        '20' => [
            '100' => [96,188],
            '200' => [190,376],
            '400' => [378,564],
            '600' => [566,752],
            '800' => [754,940],
            '1000' => [942,1128],
            '1200' => [1130,1316],
            '1400' => [1318,2820],
            '3000' => [2822,4700],
            '5000' => [4702,9396],
            '10000' => [9398,null],
        ],
        '25' => [
            '100' => [96,188],
            '200' => [190,376],
            '400' => [378,564],
            '600' => [566,754],
            '800' => [756,942],
            '1000' => [944,1130],
            '1200' => [1132,1318],
            '1400' => [1320,2824],
            '3000' => [2826,4706],
            '5000' => [4708,9406],
            '10000' => [9408,null],
        ],
    ];
    protected static array $trioBands = [
        '2.5' => [
            '100' => [96,183],
            '200' => [186,369],
            '400' => [372,555],
            '600' => [558,741],
            '800' => [744,927],
            '1000' => [930,1113],
            '1200' => [1116,1296],
            '1400' => [1299,2781],
            '3000' => [2784,4632],
            '5000' => [4635,9258],
            '10000' => [9261,null],
        ],
        '5' => [
            '100' => [96,186],
            '200' => [189,372],
            '400' => [375,558],
            '600' => [561,744],
            '800' => [747,933],
            '1000' => [936,1119],
            '1200' => [1122,1305],
            '1400' => [1308,2796],
            '3000' => [2799,4659],
            '5000' => [4662,9312],
            '10000' => [9315,null],
        ],
        '7.5' => [
            '100' => [96,186],
            '200' => [189,372],
            '400' => [375,561],
            '600' => [564,747],
            '800' => [750,933],
            '1000' => [936,1122],
            '1200' => [1125,1308],
            '1400' => [1311,2805],
            '3000' => [2808,4671],
            '5000' => [4674,9339],
            '10000' => [9342,null],
        ],
        '10' => [
            '100' => [94,186],
            '200' => [189,375],
            '400' => [378,561],
            '600' => [564,750],
            '800' => [753,936],
            '1000' => [939,1122],
            '1200' => [1125,1311],
            '1400' => [1314,2808],
            '3000' => [2811,4680],
            '5000' => [4683,9354],
            '10000' => [9357,null],
        ],
        '15' => [
            '100' => [96,188],
            '200' => [189,375],
            '400' => [378,564],
            '600' => [567,750],
            '800' => [753,939],
            '1000' => [942,1125],
            '1200' => [1128,1314],
            '1400' => [1317,2817],
            '3000' => [2820,4692],
            '5000' => [4695,9378],
            '10000' => [9381,null],
        ],
        '20' => [
            '100' => [96,186],
            '200' => [189,375],
            '400' => [378,564],
            '600' => [567,753],
            '800' => [756,939],
            '1000' => [942,1128],
            '1200' => [1131,1317],
            '1400' => [1320,2820],
            '3000' => [2823,4701],
            '5000' => [4704,9396],
            '10000' => [9399,null],
        ],
        '25' => [
            '100' => [96,186],
            '200' => [189,375],
            '400' => [378,564],
            '600' => [567,753],
            '800' => [756,942],
            '1000' => [945,1128],
            '1200' => [1131,1317],
            '1400' => [1320,2823],
            '3000' => [2826,4704],
            '5000' => [4707,9405],
            '10000' => [9408,null],
        ],
    ];
    protected static array $squadBands = [
        '2.5' => [
            '100' => [96,184],
            '200' => [188,368],
            '400' => [372,556],
            '600' => [560,740],
            '800' => [744,928],
            '1000' => [932,1112],
            '1200' => [1116,1296],
            '1400' => [1300,2780],
            '3000' => [2784,4632],
            '5000' => [4636,9256],
            '10000' => [9260,null],
        ],
        '5' => [
            '100' => [96,184],
            '200' => [188,372],
            '400' => [376,560],
            '600' => [564,744],
            '800' => [748,932],
            '1000' => [936,1120],
            '1200' => [1124,1304],
            '1400' => [1308,2796],
            '3000' => [2800,4660],
            '5000' => [4664,9312],
            '10000' => [9316,null],
        ],
        '7.5' => [
            '100' => [96,184],
            '200' => [188,372],
            '400' => [376,560],
            '600' => [564,748],
            '800' => [752,932],
            '1000' => [936,1120],
            '1200' => [1124,1308],
            '1400' => [1312,2804],
            '3000' => [2808,4672],
            '5000' => [4676,9336],
            '10000' => [9340,null],
        ],
        '10' => [
            '100' => [96,184],
            '200' => [188,372],
            '400' => [376,560],
            '600' => [564,748],
            '800' => [752,936],
            '1000' => [940,1124],
            '1200' => [1128,1312],
            '1400' => [1316,2808],
            '3000' => [2812,4680],
            '5000' => [4684,9356],
            '10000' => [9360,null],
        ],
        '15' => [
            '100' => [96,188],
            '200' => [192,376],
            '400' => [380,564],
            '600' => [568,752],
            '800' => [756,936],
            '1000' => [940,1124],
            '1200' => [1128,1312],
            '1400' => [1316,2816],
            '3000' => [2820,4692],
            '5000' => [4696,9380],
            '10000' => [9384,null],
        ],
        '20' => [
            '100' => [96,188],
            '200' => [192,376],
            '400' => [380,564],
            '600' => [568,752],
            '800' => [756,940],
            '1000' => [944,1128],
            '1200' => [1132,1316],
            '1400' => [1320,2820],
            '3000' => [2824,4700],
            '5000' => [4704,9396],
            '10000' => [9400,null],
        ],
        '25' => [
            '100' => [96,188],
            '200' => [192,376],
            '400' => [380,564],
            '600' => [568,752],
            '800' => [756,940],
            '1000' => [944,1128],
            '1200' => [1132,1316],
            '1400' => [1320,2824],
            '3000' => [2828,4704],
            '5000' => [4708,9404],
            '10000' => [9408,null],
        ],
    ];

    public static function getTournamentLimits($teamSize, $fee, $tournamentSize) {

        $availableBands = [
            '1' => self::$soloBands,
            '2' => self::$duoBands,
            '3' => self::$trioBands,
            '4' => self::$squadBands,
        ];

        return $availableBands[(string)$teamSize][(string)$fee][(string)$tournamentSize];
    }
}
<?php
$scale1 = $argv[1];
$scale2 = $argv[2];
$weights = array_map('intval', explode(',', $argv[3]));
arsort($weights);

$bigWeight = ($scale1 > $scale2) ? $scale1 : $scale2;
$smallWeight = ($scale1 < $scale2) ? $scale1 : $scale2;
$remainder = $bigWeight - $smallWeight;

function gewichtenFixer($array, $sum)
{
    $tempArr = [];

    while (array_sum($tempArr) !== $sum) {
        foreach ($array as $value) {
            if ($value > $sum) {
                unset($array[0]);
                $array = array_values($array);
            }
            if ($value < $sum) {
                array_push($tempArr, $value);
                continue;
            }
        }
        if (array_sum($tempArr) !== $sum) {
            unset($array[0]);
            $array = array_values($array);
            $tempArr = [];
        } if(empty($array)) {
            print("Niet in balans");
            exit();
        }
        print_r($array);
    }
    print(implode(',', $tempArr));
}

gewichtenFixer($weights, $remainder);

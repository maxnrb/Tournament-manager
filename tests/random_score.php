<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 26/03/2019
 * Time: 18:32
 */

function getRandomScore() {
    $random = rand(0, 100);

    switch ($random) {
        case $random < 5 :
            return rand(7,9);
            break;

        case $random >= 5 && $random < 15 :
            return rand(5,6);
            break;

        case $random >= 15 && $random < 25 :
            return 4;
            break;

        case $random >= 25 && $random < 40 :
            return 3;
            break;

        case $random >= 40 :
            return rand(0,2);
            break;
    }
    return null;
}
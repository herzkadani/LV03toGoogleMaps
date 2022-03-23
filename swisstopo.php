<?php

// Convert CH y/x to WGS lat
function CHtoWGSlat($y, $x)
{

    // Converts military to civil and  to unit = 1000km
    // Auxiliary values (% Bern)
    $y_aux = ($y - 600000) / 1000000;
    $x_aux = ($x - 200000) / 1000000;

    // Process lat
    $lat = 16.9023892
        +  3.238272 * $x_aux
        -  0.270978 * pow($y_aux, 2)
        -  0.002528 * pow($x_aux, 2)
        -  0.0447   * pow($y_aux, 2) * $x_aux
        -  0.0140   * pow($x_aux, 3);

    // Unit 10000" to 1 " and converts seconds to degrees (dec)
    $lat = $lat * 100 / 36;

    return $lat;
}

// Convert CH y/x to WGS long
function CHtoWGSlong($y, $x)
{

    // Converts military to civil and  to unit = 1000km
    // Auxiliary values (% Bern)
    $y_aux = ($y - 600000) / 1000000;
    $x_aux = ($x - 200000) / 1000000;

    // Process long
    $long = 2.6779094
        + 4.728982 * $y_aux
        + 0.791484 * $y_aux * $x_aux
        + 0.1306   * $y_aux * pow($x_aux, 2)
        - 0.0436   * pow($y_aux, 3);

    // Unit 10000" to 1 " and converts seconds to degrees (dec)
    $long = $long * 100 / 36;

    return $long;
}

?>
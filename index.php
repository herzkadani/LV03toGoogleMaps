<!DOCTYPE html>
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

$linkvisibility = "hidden";
$linkvisibility = (isset($_POST['submit'])) ? 'visible' : 'hidden';

$link = "";
if (isset($_POST['submit'])) {
    $eastLV = (strlen($_POST['eastLV']) > 6) ? substr($_POST['eastLV'], 1, 6) : $_POST['eastLV'];
    $northLV = (strlen($_POST['northLV']) > 6) ? substr($_POST['northLV'], 1, 6) : $_POST['northLV'];
    $wsgLat = CHtoWGSlat($eastLV, $northLV);
    $wsgLong = CHtoWGSlong($eastLV, $northLV);
    $link = 'https://www.google.com/maps/search/?api=1&query=' . strval($wsgLat) . '%2C' . strval($wsgLong);
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>LV03/LV95 to Google Maps</title>
</head>

<body>
    <h1>LV03 oder LV95 Koordinaten in Google Maps öffnen</h1>
    <p class="small">Koordinaten können sowohl im LV03 (600 000 / 200 000) oder LV95 (2 600 000 / 1 200 000) Format eingegeben werden.</p>
    <form action="" method="post">
        <div><label for="eastLV">Ost ( (2) 600 000 )</label>
            <input type="number" name="eastLV" value="<?= (isset($_POST['submit'])) ? $_POST['eastLV'] : ""; ?>" required>
        </div>

        <div><label for="eastLV">Nord ( (1) 200 000 )</label>
            <input type="number" name="northLV" value="<?= (isset($_POST['submit'])) ? $_POST['northLV'] : ""; ?>" required>
        </div>
        <div><input type="submit" value="Link erstellen" name="submit"></div>
        <div><input type="reset" value="Eingabe löschen" name="clear"></div>

    </form>
    <a href="<?= $link ?>" style="visibility:<?= $linkvisibility ?>">
        <div>in Google Maps öffnen</div>
    </a>
</body>

</html>
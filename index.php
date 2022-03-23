<!DOCTYPE html>
<?php

include 'swisstopo.php';

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
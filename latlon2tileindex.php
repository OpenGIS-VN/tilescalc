<?php

header('Content-Type: application/json');

function latLonToTileXY($lat, $lon, $zoom) {
    $tileX = floor(($lon + 180) / 360 * pow(2, $zoom));
    $tileY = floor((1 - log(tan(deg2rad($lat)) + 1 / cos(deg2rad($lat))) / M_PI) / 2 * pow(2, $zoom));
    return ['x' => $tileX, 'y' => $tileY, 'z' => $zoom];
}


// https://api.opengis.vn/tilescalc/latlon2tileindex.php?lat=10.762622&lon=106.660172&zoom=15&fmat=png&baseurl=https://tile.openstreetmap.org
// https://api.opengis.vn/tilescalc/latlon2tileindex.php?lat=10.762622&lon=106.660172&zoom=15&fmat=png&baseurl=https://cdn.estatemanner.com/tile/qhsdd
if (isset($_GET['lat']) && isset($_GET['lon']) && isset($_GET['zoom']) && isset($_GET['fmat'])) {
    $lat = floatval($_GET['lat']);
    $lon = floatval($_GET['lon']);
    $zoom = intval($_GET['zoom']);
    $fmat = $_GET['fmat'];
    $baseurl = $_GET['baseurl'];

    if (is_numeric($lat) && is_numeric($lon) && is_numeric($zoom)) {
        $tile = latLonToTileXY($lat, $lon, $zoom);
        $url = "$baseurl/{$tile['z']}/{$tile['x']}/{$tile['y']}.$fmat";

        echo json_encode([
            'status' => 'success',
            'url' => $url
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing parameters'
    ]);
}

?>

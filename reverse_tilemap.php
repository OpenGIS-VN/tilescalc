<?php

header('Content-Type: application/json');

function tileXYToLatLon($x, $y, $zoom) {
    $n = pow(2, $zoom);
    $lon = $x / $n * 360.0 - 180.0;
    $lat_rad = atan(sinh(M_PI * (1 - 2 * $y / $n)));
    $lat = rad2deg($lat_rad);

    return ['lat' => $lat, 'lon' => $lon, 'zoom' => $zoom];
}

// https://api.opengis.vn/tilescalc/reverse_tilemap.php?url=https://cdn.estatemanner.com/tile/qhsdd/17/104369/61594.png
// https://api.opengis.vn/tilescalc/reverse_tilemap.php?url=https://tile.openstreetmap.org/15/26092/15398.png
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Tách các tham số z, x, y từ URL
    if (preg_match('/\/(\d+)\/(\d+)\/(\d+)\.png/', $url, $matches)) {
        $zoom = intval($matches[1]);
        $x = intval($matches[2]);
        $y = intval($matches[3]);

        // Chuyển đổi từ tile X, Y thành lat, lon
        $coordinates = tileXYToLatLon($x, $y, $zoom);

        echo json_encode([
            'status' => 'success',
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lon'],
            'zoom' => $coordinates['zoom']
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid URL format'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing URL parameter'
    ]);
}

?>

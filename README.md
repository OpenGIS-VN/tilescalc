# tilescalc
Tile Map URL Generator

## Quick look

![image](https://github.com/user-attachments/assets/1c1fb35b-37d0-471a-8a80-19458f6b516d)

## API Lon, Lat, Zoom to tileset

https://api.opengis.vn/tilescalc/latlon2tileindex.php?lat=10.762622&lon=106.660172&zoom=15&fmat=png&baseurl=https://tile.openstreetmap.org

```json
{
  "status": "success",
  "url": "https://tile.openstreetmap.org/15/26092/15398.png"
}
```

## API Reverse tilemap

https://api.opengis.vn/tilescalc/reverse_tilemap.php?url=https://tile.openstreetmap.org/15/26092/15398.png

```json
{
  "status": "success",
  "latitude": 10.7685558077324,
  "longitude": 106.6552734375,
  "zoom": 15
}
```
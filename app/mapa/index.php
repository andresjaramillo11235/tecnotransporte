<?php

print_r($_REQUEST);

if (isset($_GET['pto'])){
  $punto = true;
} else {
  $punto = false;
}

function courseFormatter($value) {
  $courseValues = array(
      'icono-1.png',
      'icono-2.png', 
      'icono-3.png', 
      'icono-4.png', 
      'icono-5.png',
      'icono-6.png',
      'icono-7.png',
      'icono-8.png');
  
  return $courseValues[floor($value / 45)];
}


include_once '../controllers/CurlTraccarController.php';

if (isset($_REQUEST['fi']) && isset($_REQUEST['ff'])) {
  // Datos de posicion del movil
  $url = 'positions?';
  $url .= 'deviceId=' . $_GET['id'];
  $url .= '&from=' . $_GET['fi'];
  $url .= '&to=' . $_GET['ff'];

  $method = 'GET';
  $posiciones = CurlTraccarController::request($url, $method);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script type="module">

      const positions = [
          <?php for ($i=0; $i<count($posiciones); $i++) { 
              if (isset($_GET['pto'])){
                if ($posiciones[$i]->id == $_GET['pto']){
                  $ptoLat = $posiciones[$i]->latitude;
                  $ptoLng = $posiciones[$i]->longitude;
                }
              }
            ?>
            {
              lat: <?php echo $posiciones[$i]->latitude?>, 
              lng: <?php echo $posiciones[$i]->longitude?>, 
              icon: "../views/img/mapa/<?php echo courseFormatter($posiciones[$i]->course);?>",
              info: "<b><?php 
                        echo date_format(date_create($posiciones[$i]->fixTime), 'Y-m-d H:i')
                        ?></b><br><?php echo $posiciones[$i]->speed?> km/h",
              
            },
          <?php } ?>
      ];
      
      // Initialize and add the map
      let map;

      async function initMap(positions) {
          

          // Request needed libraries.
          //@ts-ignore
          const {Map} = await google.maps.importLibrary("maps");
          const {AdvancedMarkerView} = await google.maps.importLibrary("marker");
          const bounds = new google.maps.LatLngBounds();

          <?php if ($punto) { ?>
          const position = {lat: <?php echo $ptoLat; ?>, lng: <?php echo $ptoLng; ?>};

          map = new Map(document.getElementById("map"), {
              zoom: 20,
              center: position,
              mapId: "DEMO_MAP_ID",
          });
          <?php } else { ?>
              map = new Map(document.getElementById("map"), {
              //zoom: 10,
              //center: position,
              //mapId: "DEMO_MAP_ID",
          });

          <?php }  ?>


          positions.forEach((position, index) => {
              const {lat,lng,icon,info} = position; //
              //const marker = new AdvancedMarkerView({
              const marker = new google.maps.Marker({
                  map: map,
                  position: {lat,lng},
                  icon: {
                    url: icon,
                    anchor: new google.maps.Point(23,23)
                  },
                  title: `Posicion: ${index + 1}`
              });

              // Create an InfoWindow for the marker
              const infoWindow = new google.maps.InfoWindow({
                content: info,
              });

              marker.addListener("click", () => {
                    infoWindow.open(map, marker);
              });

              bounds.extend(position);
          });

          // Create an array to store the path for the polyline
          const polylinePath = positions.map((position) => new google.maps.LatLng(position.lat, position.lng));

          // Create a Polyline to connect all markers
          const polyline = new google.maps.Polyline({
              path: polylinePath, // Array of LatLng positions
              geodesic: true,
              strokeColor: "#FF0000", // Line color
              strokeOpacity: 1.0,
              strokeWeight: 3, // Line thickness
          });

          // Add the polyline to the map
          polyline.setMap(map);

          // Adjust the map's viewport to fit all markers and polyline
          <?php if (!$punto) {?>
            map.fitBounds(bounds);
          <?php }?>
      }

      initMap(positions);

    </script>

  </head>
  <body>
    <div id="map"></div>
    <script>(g => {
          var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window;
          b = b[c] || (b[c] = {});
          var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async(f, n) => {
                  await (a = m.createElement("script"));
                  e.set("libraries", [...r] + "");
                  for (k in g)
                      e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                  e.set("callback", c + ".maps." + q);
                  a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                  d[q] = f;
                  a.onerror = () => h = n(Error(p + " could not load."));
                  a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                  m.head.append(a)
              }));
          d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
      })
              ({key: "AIzaSyCyi82WAa4HSJZKk0jnX8pNzIEJFTDpCxA", v: "beta"});</script>
  </body>
</html>
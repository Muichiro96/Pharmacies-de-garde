@extends('shared.layout')
@section('title')
Home
@endsection
@section('content')


<div class="card"><div id="map" style="height: 400px; 
    width: 100%;"></div></div>
<div class="container"><div class="row"><div class="col-xl-4"><button class="btn btn-primary" id="currentLocation" style="width: 100%"><i class="fas fa-map-marker text-danger"></i> &nbsp;Localisez-vous</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="currentLocation" style="width: 100%;"><i class="fas fa-sun text-warning"></i> &nbsp;Pharmacies de garde Jour</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="currentLocation" style="width: 100%"><i class="fas fa-moon"></i>&nbsp; pharmacies de garde Nuit</button></div>
</div>
@auth
<div class="row">
    <div class="col">
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal">Ajouter Une Pharmacie</button>

        <div class="modal" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header bg-success">
                  <h5 class="modal-title">Ajouter Une Pharmacie</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        @csrf
                    <div class="card-body">
                    <div class="form-group">
                    <label for="name">Nom Pharmacie :</label>
                    <input type="text" name="name" class="form-control"  placeholder="Pharmcie Khouya..">
                    </div>
                    <div class="form-group">
                    <label for="address">Adresse :</label>
                    
                    <input type="text" name="address" class="form-control"  placeholder="Hay Ilham ,Dcheira..">
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone :</label>
                        
                        <input type="text" name="phone" class="form-control"  placeholder="+212687555">
                        </div>
                        <div class="form-group">
                        <label for="district">Quartier :</label>
                        
                        <input type="text" name="district" class="form-control"  placeholder="Hay Ilham">
                        </div>
                        <div class="form-group">
                            
                            <label for="longitude">Longitude :</label>
                            
                            <input type="text" name="longitude" class="form-control"  placeholder="25.1145">
                            </div>
                            <div class="form-group">
                                <label for="lattitude">Lattitude :</label>
                                
                                <input type="text" name="lattitude" class="form-control"  placeholder="1.455588">
                                </div>
                                <div class="form-group">
                                    <label for="ville">Ville :</label>
                                    <select class="form-control custom-select" name="city"  >
                                        <option value="" disabled selected>Selectionnez la ville</option>
                                        
                                        <option >
                                         test
                                        </option>
                                        
                                        </select>
                                    </div>
                    
                    
                   
                    
                
                    
                    
                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>@endauth
</div>
<script>

  ((g) => {
    var h,
      a,
      k,
      p = "The Google Maps JavaScript API",
      c = "google",
      l = "importLibrary",
      q = "__ib__",
      m = document,
      b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}),
      r = new Set(),
      e = new URLSearchParams(),
      u = () =>
        h ||
        (h = new Promise(async (f, n) => {
          await (a = m.createElement("script"));
          e.set("libraries", [...r] + "");
          for (k in g)
            e.set(
              k.replace(/[A-Z]/g, (t) => "_" + t[0].toLowerCase()),
              g[k]
            );
          e.set("callback", c + ".maps." + q);
          a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
          d[q] = f;
          a.onerror = () => (h = n(Error(p + " could not load.")));
          a.nonce = m.querySelector("script[nonce]")?.nonce || "";
          m.head.append(a);
        }));
    d[l]
      ? console.warn(p + " only loads once. Ignoring:", g)
      : (d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)));
  })({ key: "AIzaSyCOd2qg9cSqNNN3bJvec7_GK_YrFpyQgw0", v: "weekly" });
  let map;

async function initMap() {

const position = { lat: 30.42068147260423, lng : -9.599089574524355 }
// Request needed libraries.
//@ts-ignore
const locationImage = document.createElement("img");
locationImage.src="/mylocation.png";
locationImage.style="width:70px;height:70px";
const { Map } = await google.maps.importLibrary("maps");


const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
const geocoder = new google.maps.Geocoder();
const infowindow = new google.maps.InfoWindow();

// The map, centered at Uluru
map = new Map(document.getElementById("map"), {
zoom: 6,
center: position,
mapId: "DEMO_MAP_ID",
});

// The marker, positioned at Uluru

let locationButton = document.getElementById("currentLocation");

locationButton.addEventListener("click", () => {
// Try HTML5 geolocation.
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      const pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
        const marker = new AdvancedMarkerElement({
        map: map,
        position: pos,
        content: locationImage,
        title: "Your position",
    });
      
      
      map.setCenter(pos);
      map.setZoom(17);
      var currentPosition = new google.maps.LatLng(pos.lat,pos.lng);
      marker.addListener("click", () => {
        infowindow.setContent(`<div id='content'><h4 id='firstHeading' class='firstHeading'><i class='fas fa-map-marker text-danger'></i>Votre Position </h4><br/>
        Lattitude : ${pos.lat} , Longitude : ${pos.lng}
        </div>`);
    infowindow.open({
      anchor: marker,
      map,
    });
  });
      geocodeLatLng(geocoder, map, infowindow,pos);
      
    },
    () => {
      handleLocationError(true, infoWindow, map.getCenter());
    },
  );
 
} else {
  // Browser doesn't support Geolocation
  handleLocationError(false, infoWindow, map.getCenter());
}
});
}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(
browserHasGeolocation
  ? "Error: The Geolocation service failed."
  : "Error: Your browser doesn't support geolocation.",
);
infoWindow.open(map);
}
function callback(results, status) {
if (status == google.maps.places.PlacesServiceStatus.OK) {
for (var i = 0; i < results.length; i++) {
  createMarker(results[i]);
}
}
}

function geocodeLatLng(geocoder, map, infowindow,position) {
 
  const latlng = {
    lat:position.lat,
    lng: position.lng,
  };

  geocoder
    .geocode({ location: latlng })
    .then((response) => {
      if (response.results[0]) {
        map.setZoom(11);

        const marker = new google.maps.Marker({
          position: latlng,
          map: map,
        });

        infowindow.setContent(response.results[0].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert("No results found");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}

initMap();

</script>
@endsection
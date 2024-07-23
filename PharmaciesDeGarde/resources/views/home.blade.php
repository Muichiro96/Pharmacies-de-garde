@extends('shared.layout')
@section('title')
Home
@endsection
@section('content')


<div class="card"><div id="map" style="height: 400px; 
    width: 100%;"></div></div>
<div class="container"><div class="row"><div class="col-xl-4"><button class="btn btn-primary" id="currentLocation" style="width: 100%"><i class="fas fa-map-marker text-danger"></i> &nbsp;Localisez-vous</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="currentLocation" style="width: 100%;"><i class="fas fa-sun text-warning"></i> &nbsp;Pharmacies de garde Jour</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="currentLocation" style="width: 100%"><i class="fas fa-moon "></i>&nbsp; Pharmacies de garde Nuit</button></div>
</div>
<div class="row">
  <div class="col">
   
    <button type="button" class="btn btn-dark mt-2" style="width: 100%;"><i class="fas fa-history text-primary"></i>&nbsp; Pharmacies de garde &nbsp;<span class="badge bg-success" style="font-weight: bold;">24h/24</span>
    </button>
  </div>
  <div class="col">
    <button  class="btn btn-secondary mt-2" style="width: 100%;"><i class="fas fa-clock"></i>&nbsp;Horaire normal</button>
  </div>
</div>

  <div class="row">
    <div class="col">
    <input type="text" class="form-control mt-4" style="width: 100%;" placeholder="Rechercher par adresse,quartier ou ville">  
    </div></div>
    <div class="row">
      <div class="col">
        <div class="mt-4" id="ville">
        <span>Votre position :</span><div class="card"><div class="card-body"></div></div>
          
      </div>
      </div>
    </div>
@auth
<div class="row">
  <div class="col-md-4"></div>
    <div class="col-md-4">
        <br/>
        <button type="button" class="btn btn-warning"  style="width: 100%;" data-toggle="modal" data-target=".modal"><i class="fas fa-edit"></i>&nbsp;Ajouter ou Compléter  une pharmacie</button>




        <div  class="modal" tabindex="-1">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header bg-success">
                  
                  <h5 class="modal-title"><i class="modal-icon fas fa-plus-square text-black"></i>&nbsp;Ajouter Une Pharmacie</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/suggestion/add">
                        @csrf
                        @if($errors->any())
                        <script>
                          $('.modal').modal('show');
                        
                        </script>
<div class="alert alert-warning alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
</ul>
</div> 

@endif

@if(session()->has('success'))
<script>
  $('.modal').modal('show');

</script>
<div class="alert alert-success alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i>Succés </h4>
{{ session()->get('success') }}
</div>@endif
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
                        <label for="district">Quartier</label>(optionnel)<label>:</label>
                        
                        <input type="text" name="district" class="form-control"  placeholder="Hay Ilham">
                        </div>
                        <div class="form-group">
                          <label for="lattitude">Lattitude :</label>
                          
                          <input type="text" name="lattitude" class="form-control"  placeholder="1.455588">
                          </div>
                        <div class="form-group">
                            
                            <label for="longitude">Longitude :</label>
                            
                            <input type="text" name="longitude" class="form-control"  placeholder="25.1145">
                            </div>
                            
                                <div class="form-group">
                                    <label for="ville">Ville :</label>
                                    <select class="form-control custom-select" name="city"  >
                                        <option value="" disabled selected>Selectionnez la ville</option>
                                        @foreach($villes as $ville)
                                        <option>
                                         {{ $ville->nom }}
                                        </option>
                                        @endforeach
                                        
                                        </select>
                                    </div>
                    
                    
                   
                    
                
                    
                    
                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form>
              </div>
            </div>
          </div>
    </div>
    <div class="col-md-4"></div>
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
      map.setZoom(13);
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

        const div = document.getElementById("Adresse");
        div.innerHTML=response.results[0].formatted_address;
        console.log(response.results[0]);

        
      } else {
        window.alert("No results found");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}

initMap();

</script>
@endsection
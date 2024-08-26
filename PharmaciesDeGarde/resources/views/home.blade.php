@extends('shared.layout')
@section('title')
Home
@endsection

@section('content')


<div class="card"><div id="map" style="height: 400px; 
    width: 100%;"></div></div>
<div class="container"><div class="row"><div class="col-xl-4"><button class="btn btn-primary" id="currentLocation" style="width: 100%"><i class="fas fa-map-marker text-danger"></i> &nbsp;Localisez-vous</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="gardeJour" style="width: 100%;"><i class="fas fa-sun text-warning"></i> &nbsp;Pharmacies de garde Jour</button></div>
<div class="col-xl-4"><button class="btn btn-success" id="gardeNuit" style="width: 100%"><i class="fas fa-moon "></i>&nbsp; Pharmacies de garde Nuit</button></div>
</div>
<div class="row">
  <div class="col">
   
    <button type="button" class="btn btn-danger mt-2" id="gardeAllDay" style="width: 100%;"><i class="fas fa-history text-dark"></i>&nbsp; Pharmacies de garde &nbsp;<span class="badge bg-olive" style="font-weight: bold;">24h/24</span>
    </button>
  </div>
  <div class="col">
    <button  class="btn btn-secondary mt-2" style="width: 100%;" id="pharmacies"><i class="fas fa-clock"></i>&nbsp;Horaire normal</button>
  </div>
</div>

  <div class="row">
    <div class="col">
    <input type="text" id="autocomplete" class="form-control mt-4" style="width: 100%;" placeholder="Rechercher par adresse,quartier ou ville">  
    </div></div>
    <div class="row">
      <div class="col">
        <div class="mt-4" id="ville">
        <span>Votre position :</span><div class="card mt-2"><div class="card-body" id="adresse"></div></div>
          
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
  })({ key: "AIzaSyB5ko5GZfVEHS8MB_tB1sfaVu3-su42Zc0", v: "weekly"});
  
  let map;
  let markers = [];
  let pharmacieMarkers = [];
async function initMap() {

const position = { lat: 30.42068147260423, lng : -9.599089574524355 }
// Request needed libraries.
//@ts-ignore
const locationImage = document.createElement("img");
locationImage.src="/myposition.png";
locationImage.style="width:90px;height:70px";

const { Map } = await google.maps.importLibrary("maps");

let collisionBehavior = google.maps.CollisionBehavior.REQUIRED;
const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
const geocoder = new google.maps.Geocoder();
const infowindow = new google.maps.InfoWindow();
const {Autocomplete} = await google.maps.importLibrary("places");


// The map, centered at Uluru
map = new Map(document.getElementById("map"), {
zoom: 6,
center: position,
mapId: "DEMO_MAP_ID",
});

// The marker, positioned at Uluru

let locationButton = document.getElementById("currentLocation");
let gardeNuitButton = document.getElementById("gardeNuit");
let gardeJourButton = document.getElementById("gardeJour");
let pharmaciesButton  = document.getElementById("pharmacies");
let gardeAllDayButton  = document.getElementById("gardeAllDay");
const options = {
 componentRestrictions: { country: "ma" },
    fields: ["formatted_address", "geometry", "name"],
    strictBounds: false,
  };

 

  const autocomplete = new Autocomplete(document.getElementById("autocomplete"), options);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
 autocomplete.addListener("place_changed", () => {
	deleteMarkers();
  deletePharmacieMarker();
    infowindow.close();
	
    

    const place = autocomplete.getPlace();

    if (!place.geometry || !place.geometry.location) {
      
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }
	
	m=new AdvancedMarkerElement({
        map: map,
         position:place.geometry.location,
         content: locationImage,
         zIndex: 999,
        });
      
    
	
        geocodeLatLng(geocoder, map,{lat: place.geometry.location.lat(),lng: place.geometry.location.lng() });
  m.addListener("click", () => {
        infowindow.setContent(`<div id='content'><h4 id='firstHeading' class='firstHeading'><i class='fas fa-map-marker text-danger'></i>Votre Position </h4><br/>
        <label>Lattitude :</label>&nbsp; ${place.geometry.location.lat()} , <label>Longitude :</label>&nbsp; ${place.geometry.location.lng()}<br/><br/>
        <label>Adresee : </label>&nbsp;${document.getElementById('monAdresse').textContent}
        </div>`);
    infowindow.open({
      anchor: m,
      map,
    });
	
  });
  
  addMarker(m);
     });
	 
	 

gardeJourButton.addEventListener("click",()=> {
  if(document.getElementById("cityquery")){
    deletePharmacieMarker();
    $.ajax({
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('GardeJour')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({ville : document.getElementById("cityquery").textContent}),
            success: function(data){
              if(data.pharmacies.length>0){
              for(pharmacie of data.pharmacies){
                for(ph of pharmacie.pharmacies){
                    
                    const pos = {
                      lat:parseFloat( ph.lattitude),
                      lng: parseFloat(ph.longitude),
                    };
                 
                const gardeJourImage = document.createElement("img");
                gardeJourImage.src="/jour.png";
                gardeJourImage.style="width:50px;height:50px";

                const marker=new AdvancedMarkerElement({
                  map: map,
                  position:pos,
                  content: gardeJourImage,
                  collisionBehavior: collisionBehavior,

                });
                const content=`<h3 class="text-success">
   <i class="fas fa-hospital"></i> ${ph.nom}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; ${ph.adresse}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; ${ph.telephone}
<br/>`;
                marker.addListener('click',function(){
                        infowindow.setContent(content);
                infowindow.open({
                  anchor: marker,
                  map,
                  
                });

                });
                addPharmacieMarker(marker);
                
               }
              }
            }}
    });
    
  }
  else{
    alert("S'il vous plait,localisez-vous D'abord");
  }
});
gardeAllDayButton.addEventListener("click",()=> {
  if(document.getElementById("cityquery")){
    deletePharmacieMarker();
    $.ajax({
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('GardeAllDay')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({ville : document.getElementById("cityquery").textContent}),
            success: function(data){
              if(data.pharmacies){
              for(pharmacie of data.pharmacies){
                for(ph of pharmacie.pharmacies){
                    
                    const pos = {
                      lat:parseFloat( ph.lattitude),
                      lng: parseFloat(ph.longitude),
                    };
                 
                const gardeAllDayImage = document.createElement("img");
                gardeAllDayImage.src="/allDay.png";
                gardeAllDayImage.style="width:55px;height:60px";

                const marker=new AdvancedMarkerElement({
                  map: map,
                  position:pos,
                  content: gardeAllDayImage,
                  collisionBehavior: collisionBehavior,

                });
                const content=`<h3 class="text-success">
   <i class="fas fa-hospital"></i> ${ph.nom}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; ${ph.adresse}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; ${ph.telephone}
<br/>`;
                marker.addListener('click',function(){
                        infowindow.setContent(content);
                infowindow.open({
                  anchor: marker,
                  map,
                  
                });

                });
                addPharmacieMarker(marker);
                
               }
              }
            }}
    });
    
  }
  else{
    alert("S'il vous plait,localisez-vous D'abord");
  }
});
gardeNuitButton.addEventListener("click",()=> {
  if(document.getElementById("cityquery")){
    deletePharmacieMarker();
    $.ajax({
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('GardeNuit')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({ville : document.getElementById("cityquery").textContent}),
            success: function(data){
              if(data.pharmacies){
              for(pharmacie of data.pharmacies){
                for(ph of pharmacie.pharmacies){
                    
                    const pos = {
                      lat:parseFloat( ph.lattitude),
                      lng: parseFloat(ph.longitude),
                    };
                 
                const gardeNuitImage = document.createElement("img");
                gardeNuitImage.src="/nuit.png";
                gardeNuitImage.style="width:50px;height:50px";

                const marker=new AdvancedMarkerElement({
                  map: map,
                  position:pos,
                  content: gardeNuitImage,
                  collisionBehavior: collisionBehavior,

                });
                const content=`<h3 class="text-success">
   <i class="fas fa-hospital"></i> ${ph.nom}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; ${ph.adresse}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; ${ph.telephone}
<br/>`;
                marker.addListener('click',function(){
                        infowindow.setContent(content);
                infowindow.open({
                  anchor: marker,
                  map,
                  
                });

                });
                addPharmacieMarker(marker);
                
               }
              }
            }}
    });
    
  }
  else{
    alert("S'il vous plait,localisez-vous D'abord");
  }
});
pharmaciesButton.addEventListener("click",()=> {
  if(document.getElementById("cityquery")){
    deletePharmacieMarker();
    console.log(document.getElementById("cityquery").textContent);
    $.ajax({
      headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            type: "POST",
            url: "{{route('pharmacies')}}",
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({ville : document.getElementById("cityquery").textContent}),
            success: function(data){
              
              
            for(pharmacie of data.pharmacies){
                console.log(pharmacie);
                    
                    const pos = {
                      lat:parseFloat( pharmacie.lattitude),
                      lng: parseFloat(pharmacie.longitude),
                    };
                 
                const pharmacieImage = document.createElement("img");
                pharmacieImage.src="/pharmacie.png";
                pharmacieImage.style="width:50px;height:50px";

                const marker=new AdvancedMarkerElement({
                  map: map,
                  position:pos,
                  content: pharmacieImage,
                  

                });
                
                const content=`<h3 class="text-success">
   <i class="fas fa-hospital"></i> ${pharmacie.nom}
</h3>

<i class="fas fa-building"></i> &emsp;<label>Adresse :</label>&emsp; ${pharmacie.adresse}
<br/>
<i class="fas fa-phone-alt"></i>&emsp;<label>Téléphone :</label>&emsp; ${pharmacie.telephone}
<br/>`;
                marker.addListener('click',function(){
                        infowindow.setContent(content);
                        
                infowindow.open({
                  anchor: marker,
                  map,
                  
                });

                });
                addPharmacieMarker(marker);
                
               }
             
            }
    });
    
  }
  else{
    alert("S'il vous plait,localisez-vous D'abord");
  }
});
locationButton.addEventListener("click", () => {
  deletePharmacieMarker();
// Try HTML5 geolocation.
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(
    (position) => {
      const pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
      
		deleteMarkers();
        const marker = new AdvancedMarkerElement({
        map: map,
        position: pos,
        content: locationImage,
        zIndex: 999,
        title: "Your position",
    });
      
      
    geocodeLatLng(geocoder, map,pos);
      map.setCenter(pos);
      map.setZoom(19);
      marker.addListener("click", () => {
        infowindow.setContent(`<div id='content'><h4 id='firstHeading' class='firstHeading'><i class='fas fa-map-marker text-danger'></i>Votre Position </h4><br/>
        <label>Lattitude :</label>&nbsp; ${pos.lat} , <label>Longitude : </label>&nbsp;${pos.lng}<br/><br/>
        <label>Adresee :</label>&nbsp; ${document.getElementById('monAdresse').textContent}
        </div>`);
    infowindow.open({
      anchor: marker,
      map,
    });
	
  });
	addMarker(marker);
     
      
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

function geocodeLatLng(geocoder, map,position) {
 
  const latlng = {
    lat:position.lat,
    lng: position.lng,
  };

  geocoder
    .geocode({ location: latlng, 'language': 'fr' })
    .then((response) => {
      if (response.results[0]) {
        map.setZoom(11);
		const div=document.getElementById("adresse");
		
		var arrAddress = response.results[0].address_components;
		var itemSublocality='';
		var itemAreaFirstLevel='';
		var itemAreaSecondLevel='';
		var itemLocality='';
		var itemCountry='';
		var itemPc='';
		var itemSnumber='';

	
		for(let i=0;i < arrAddress.length;i++) {
		

			if (arrAddress[i].types[0] == "locality"){
				
				itemLocality = arrAddress[i].long_name;
			}

			if (arrAddress[i].types[0] == "country"){ 
				
				itemCountry = arrAddress[i].long_name;
			}

			if (arrAddress[i].types[0] == "postal_code"){ 
				
				itemPc = arrAddress[i].long_name;
			}
	
			if (arrAddress[i].types[0] == "administrative_area_level_2"){ 
				 
				itemAreaSecondLevel = arrAddress[i].long_name;
			}
			if (arrAddress[i].types[0] == "administrative_area_level_1"){ 
				  
				itemAreaFirstLevel = arrAddress[i].long_name;
			}
	
			if (arrAddress[i].types[1] == "sublocality"){ 
				
				itemSublocality = arrAddress[i].long_name;
			}
   
}
		div.innerHTML=`<label>Ville :&emsp;</label><span id='cityquery'>${itemLocality}</span>
		&emsp;<label>Cité :&emsp;</label>${itemSublocality }<br/>
		<label>Province:</label>&emsp;${itemAreaSecondLevel}
		&emsp;<label>Région :</label>&emsp;${itemAreaFirstLevel}<br/>
		<label>Adresse:&emsp;</label><span id='monAdresse'>${response.results[0].formatted_address}</span>`;
		
		
       
      } else {
        window.alert("No results found");
      }
    })
    .catch((e) => window.alert("Geocoder failed due to: " + e));
}
function addMarker(marker) {
 markers.push(marker);
}


function setMapOnAll(map) {
  for (let i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
function setMapOnPharmacies(map){
  for (let i = 0; i < pharmacieMarkers.length; i++) {
    pharmacieMarkers[i].setMap(map);
  }
}
function hidePharmaciesMarkers(){
  setMapOnPharmacies(null);
}

function hideMarkers() {
  setMapOnAll(null);
}



function deleteMarkers() {
  hideMarkers();
  markers = [];
}
function addPharmacieMarker(marker){
  
  pharmacieMarkers.push(marker);
}
function deletePharmacieMarker(){
hidePharmaciesMarkers();
pharmacieMarkers= [];
}
initMap();

</script>
@endsection
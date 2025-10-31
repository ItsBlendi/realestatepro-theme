function initAutocomplete(){
  // Autocomplete for front page
  var input = document.getElementById('search-location');
  if(!input) input = document.getElementById('search-location-archive');
  if(!input) return;
  var autocomplete = new google.maps.places.Autocomplete(input, {types:['(cities)']});
  autocomplete.setFields(['geometry','formatted_address']);
}

function initPropertyMap(){
  // Call autocomplete first (if available)
  try{ initAutocomplete(); }catch(e){}

  // Single property map
  var main = document.getElementById('property-map');
  if(main){
    var lat = parseFloat(main.dataset.lat);
    var lng = parseFloat(main.dataset.lng);
    var map = new google.maps.Map(main, {zoom:16,center:{lat:lat,lng:lng}});
    new google.maps.Marker({position:{lat:lat,lng:lng},map:map});
  }

  // Mini maps on archive (if any)
  var minis = document.querySelectorAll('.property-mini-map');
  minis.forEach(function(container){
    var lat = parseFloat(container.dataset.lat);
    var lng = parseFloat(container.dataset.lng);
    var map = new google.maps.Map(container, {zoom:12,center:{lat:lat,lng:lng}});
    new google.maps.Marker({position:{lat:lat,lng:lng},map:map});
  });
}

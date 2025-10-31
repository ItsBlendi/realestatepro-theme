document.addEventListener('DOMContentLoaded', function(){
  var btn = document.getElementById('geo-button');
  if(!btn) return;
  btn.addEventListener('click', function(){
    var address = document.getElementById('location-field').value;
    var status = document.getElementById('geo-status');
    if(!address || address.length<3){ status.textContent = 'Type a valid address first.'; return; }
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({address: address}, function(results, statusCode){
      if(statusCode === 'OK'){
        var lat = results[0].geometry.location.lat();
        var lng = results[0].geometry.location.lng();
        var latField = document.querySelector("input[name='latitude']");
        var lngField = document.querySelector("input[name='longitude']");
        if(latField) latField.value = lat;
        if(lngField) lngField.value = lng;
        status.textContent = 'Coordinates set ✅';
      } else {
        status.textContent = 'Geocoding failed: ' + statusCode;
      }
    });
  });
});

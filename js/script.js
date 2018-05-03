function initializeMap() {
    var city = {
      lat: coord.lat,
      lng: coord.lon
    };
    var cityMap = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: city
    });
    var marker = new google.maps.Marker({
      position: city,
      map: cityMap
    });
}
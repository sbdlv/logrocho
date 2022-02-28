let mapOptions = {
    center: [42.4658, -2.44999],
    zoom: 13
}
let map = new L.map('map', mapOptions);
let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

$.ajax({
    type: "GET",
    url: "index.php/bar/jsonAll",
    dataType: "json",
    success: function (response) {
        response.forEach(bar => {
            let marker = new L.Marker([bar.lat, bar.lon], {
                title: bar.name,
                draggable: false,
            });

            marker.addTo(map);
            marker.bindPopup(bar.name);
        });
    }
});

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
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

        let markerIcon = L.icon({
            iconUrl: "/img/bar_icon.png",
            iconSize: [40, 40]
        });

        response.forEach(bar => {
            let marker = new L.Marker([bar.lat, bar.lon], {
                title: bar.name,
                draggable: false,
                icon: markerIcon
            });

            //Popup body
            let stars = $("<div></div>").addClass("mb-2");

            for (let i = 0; i < Math.floor(bar.rating); i++) {
                stars.append('<i class="fas fa-star"></i>')
            }

            for (let i = 0; i < 5 - bar.rating; i++) {
                stars.append('<i class="fas fa-star off"></i>')
            }

            let body = $("<div></div>").append(
                $("<h3></h3>").text(bar.name),
                stars,
                $('<a></a>').addClass("link-primary").attr("href", `index.php/bar/${bar.id}`).text("Más información").append(
                    $('<i class="ms-2 fas fa-external-link-alt"></i>')
                ),
            )

            //Instance and add marker
            marker.addTo(map);
            marker.bindPopup(body.html());
        });
    }
});

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}
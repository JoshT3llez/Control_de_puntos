<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Válvulas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.13.0/leaflet-providers.min.js"></script>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        #map {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        const ubicaciones = @json($ubicaciones);
        const map = L.map('map').setView([ubicaciones[0].lat, ubicaciones[0].lng], 13);

        const capasBase = {
            "Calles": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }),
            "Satélite": L.tileLayer.provider('Esri.WorldImagery'),
            "Relieve": L.tileLayer.provider('OpenTopoMap'),
        };

        capasBase["Calles"].addTo(map);
        L.control.layers(capasBase).addTo(map);

        const bounds = [];
        ubicaciones.forEach(ubicacion => {
            L.marker([ubicacion.lat, ubicacion.lng])
                .addTo(map)
                .bindPopup(ubicacion.nombre); // Contenido del popup dinámico
            bounds.push([ubicacion.lat, ubicacion.lng]);
        });

        map.fitBounds(bounds);
    </script>
</body>
</html>

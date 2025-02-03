@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Detalles de la Válvula</h1>
    <div id="map" style="width: 100%; height: 500px;"></div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-providers/1.13.0/leaflet-providers.min.js"></script>

    <script>
        const latitud = {{ $valvula->altitud }};
        const longitud = {{ $valvula->longitud }};
        const map = L.map('map').setView([latitud, longitud], 13);
        const capasBase = {
            "Calles": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }),

            "Satélite": L.tileLayer.provider('Esri.WorldImagery'),

            "Relieve": L.tileLayer.provider('OpenTopoMap'),
        };
        capasBase["Calles"].addTo(map);
        L.control.layers(capasBase).addTo(map);
        const marker = L.marker([latitud, longitud]).addTo(map);
        const popupContent = `
            <strong>ID:</strong> {{ $valvula->id }}<br>
            <strong>Numero de Válvula:</strong> {{ $valvula->numero_valvula }}<br>
            <strong>Estado:</strong> {{ $valvula->estado }}<br>
            <strong>Altitud:</strong> {{ $valvula->altitud }}<br>
            <strong>Longitud:</strong> {{ $valvula->longitud }}<br>
           <strong>Sector Comercial:</strong> {{ $valvula->sectorComercial->nombre ?? 'No asignado' }}<br>
<strong>Sector Valvulero:</strong> {{ $valvula->sectorValvulero->nombre ?? 'No asignado' }}<br>

            <strong>Ubicación:</strong> {{ $valvula->ubicacion }}<br>
            <strong>Colonia/Fraccionamiento:</strong> {{ $valvula->colonia_fraccionamiento }}<br>
            <strong>Tipo:</strong> {{ $valvula->tipo }}<br>
            <strong>Diámetro de la Válvula:</strong> {{ $valvula->diametro_valvula }}<br>
            <strong>Observacion:</strong> {{ $valvula->observacion }}<br>
               <a href="https://www.google.com/maps?q={{ $valvula->altitud }},{{ $valvula->longitud }}" target="_blank">
        Ver en Google Maps
    </a>
        `;
        marker.bindPopup(popupContent).openPopup();
    </script>
@endpush
@endsection

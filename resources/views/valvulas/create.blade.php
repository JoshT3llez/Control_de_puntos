 @extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <h1>Crear Nueva Válvula</h1>

    <form action="{{ route('valvulas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="numero_valvula">Número de Válvula</label>
            <input type="text" name="numero_valvula" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="altitud">Altitud</label>
            <input type="text" id="altitud" name="altitud" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label for="longitud">Longitud</label>
            <input type="text" id="longitud" name="longitud" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label for="colonia_fraccionamiento">Colonia/Fraccionamiento</label>
            <input type="text" id="colonia_fraccionamiento" name="colonia_fraccionamiento" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" required>
            <a id="google-maps-link" href="#" target="_blank" style="display: none; margin-top: 5px;" class="btn btn-info">
                Ver en Google Maps
            </a>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sector_comercial_id">Sector Comercial</label>
            <select name="sector_comercial_id" class="form-control" required>
                @foreach($sector_comercials as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="sector_valvulero_id">Sector Valvulero</label>
            <select name="sector_valvulero_id" class="form-control" required>
                @foreach($sector_valvuleros as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        

        <div class="form-group">
            <label for="diametro_valvula">Diámetro de la Válvula</label>
            <input type="text" name="diametro_valvula" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="condicion">Condición</label>
            <input type="text" name="condicion" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="observacion">Observación</label>
            <textarea name="observacion" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Válvula</button>
    </form>

    <div id="map" style="width: 100%; height: 600px; margin-top: 20px;"></div>
</div>

<script>
    let latitud = 18.462983;
    let longitud = -97.394067;
    const map = L.map('map').setView([latitud, longitud], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    const marker = L.marker([latitud, longitud], { draggable: true }).addTo(map);

    async function getAddress(lat, lon) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
            const data = await response.json();
            const address = data.address || {};
            const road = address.road || '';
            const city = address.city || address.town || address.village || '';
            let ubicacion = road + (city ? `, ${city}` : '');
            document.getElementById('ubicacion').value = ubicacion;
            document.getElementById('google-maps-link').href = `https://www.google.com/maps?q=${lat},${lon}`;
            document.getElementById('google-maps-link').style.display = 'inline-block';
        } catch (error) {
            console.error('Error al obtener la dirección:', error);
        }
    }

    async function searchCoordinates(address) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
            const data = await response.json();
            if (data.length > 0) {
                const { lat, lon } = data[0];
                marker.setLatLng([lat, lon]);
                map.setView([lat, lon], 17);
                document.getElementById('altitud').value = lat;
                document.getElementById('longitud').value = lon;
            } else {
                alert('No se encontraron coordenadas para la dirección proporcionada.');
            }
        } catch (error) {
            console.error('Error al buscar coordenadas:', error);
        }
    }

    document.getElementById('ubicacion').addEventListener('input', (e) => {
        const address = e.target.value;
        if (address.length > 3) {
            searchCoordinates(address);
        }
    });

    marker.on('dragend', function () {
        const position = marker.getLatLng();
        document.getElementById('altitud').value = position.lat;
        document.getElementById('longitud').value = position.lng;
        getAddress(position.lat, position.lng);
    });

    getAddress(latitud, longitud);
</script>
@endsection

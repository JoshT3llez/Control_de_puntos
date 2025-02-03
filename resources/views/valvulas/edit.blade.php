@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="container">
    <h1>Editar Válvula</h1>

    <form action="{{ route('valvulas.update', $valvula->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="numero_valvula">Número de Válvula</label>
            <input type="text" name="numero_valvula" class="form-control" value="{{ $valvula->numero_valvula }}" required>
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $valvula->estado }}" required>
        </div>

        <div class="form-group">
            <label for="altitud">Altitud</label>
            <input type="text" id="altitud" name="altitud" class="form-control" value="{{ $valvula->altitud }}" readonly required>
        </div>

        <div class="form-group">
            <label for="longitud">Longitud</label>
            <input type="text" id="longitud" name="longitud" class="form-control" value="{{ $valvula->longitud }}" readonly required>
        </div>

        <div class="form-group">
            <label for="colonia_fraccionamiento">Colonia/Fraccionamiento</label>
            <input type="text" id="colonia_fraccionamiento" name="colonia_fraccionamiento" class="form-control" value="{{ $valvula->colonia_fraccionamiento }}" required>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="{{ $valvula->ubicacion }}" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $valvula->tipo }}" required>
        </div>

        <div class="form-group">
            <label for="sector_comercial">Sector Comercial</label>
            <input type="text" name="sector_comercial" class="form-control" value="{{ $valvula->sector_comercial }}" required>
        </div>

        <div class="form-group">
            <label for="sector_valvulero">Sector Valvulero</label>
            <input type="text" name="sector_valvulero" class="form-control" value="{{ $valvula->sector_valvulero }}" required>
        </div>

        <div class="form-group">
            <label for="diametro_valvula">Diámetro de la Válvula</label>
            <input type="text" name="diametro_valvula" class="form-control" value="{{ $valvula->diametro_valvula }}" required>
        </div>

        <div class="form-group">
            <label for="condicion">Condición</label>
            <input type="text" name="condicion" class="form-control" value="{{ $valvula->condicion }}" required>
        </div>

        <div class="form-group">
            <label for="observacion">Observación</label>
            <textarea name="observacion" class="form-control">{{ $valvula->observacion }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Válvula</button>
    </form>

    <div id="map" style="width: 100%; height: 500px;"></div>

</div>

<script>
    let latitud = {{ $valvula->altitud ?? 18.458798 }};
    let longitud = {{ $valvula->longitud ?? -97.382813 }};
    const map = L.map('map').setView([latitud, longitud], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);
    const marker = L.marker([latitud, longitud], { draggable: true }).addTo(map);
    async function getAddress(lat, lon) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
            const data = await response.json();
            const address = data.address || {};
            document.getElementById('ubicacion').value = `${address.road || ''}, ${address.city || ''}`;
        } catch (error) {
            console.error('Error al obtener la dirección:', error);
        }
    }
    marker.on('dragend', function(event) {
        const position = marker.getLatLng();
        document.getElementById('altitud').value = position.lat; 
        document.getElementById('longitud').value = position.lng; 
        getAddress(position.lat, position.lng);
    });
    getAddress(latitud, longitud);
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if ($errors->any())
    <script>
        let errorMessages = "";
        @foreach ($errors->all() as $error)
            errorMessages += "{{ $error }}\n";
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Error en la actualización',
            text: errorMessages,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Revisar'
        });
    </script>
@endif

@endsection

@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<div class="container">
    <h1>Crear Nueva Orden de Trabajo</h1>

    <form action="{{ route('work_orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="orden_trabajo">Orden de Trabajo</label>
            <input type="text" name="orden_trabajo" class="form-control" value="{{ old('orden_trabajo') }}" required>
            @error('orden_trabajo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="chofer_id">Chofer</label>
            <select name="chofer_id" id="chofer_id" class="form-control">
                <option value="">Seleccione un chofer</option>
                @foreach ($choferes as $chofer)
                    <option value="{{ $chofer->id }}">{{ $chofer->nombre }}</option>
                @endforeach
            </select>
            @error('chofer_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="chofer_ot">Chofer_OT</label>
            <input type="text" name="chofer_ot" class="form-control" value="{{ old('chofer_ot') }}" required>
            @error('chofer_ot') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="colonia_id">Colonia</label>
            <select name="colonia_id" class="form-control" required>
                <option value="">Seleccione una colonia</option>
                @foreach ($colonias as $colonia)
                    <option value="{{ $colonia->id }}">{{ $colonia->nombre }}</option>
                @endforeach
            </select>
            @error('colonia_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        
        <div class="form-group">
            <label for="direccion_destino">Dirección de Destino</label>
            <input type="text" name="direccion_destino" class="form-control" value="{{ old('direccion_destino') }}" required>
            @error('direccion_destino') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="destinatario">Destinatario</label>
            <input type="text" name="destinatario" class="form-control" value="{{ old('destinatario') }}">
            @error('destinatario') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="fecha_programada">Fecha Programada</label>
            <input type="date" name="fecha_programada" class="form-control" value="{{ old('fecha_programada') }}" required>
            @error('fecha_programada') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega</label>
            <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega') }}" required>
            @error('fecha_entrega') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" name="hora" class="form-control" value="{{ old('hora') }}">
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
            @error('observaciones') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crear Orden</button>
    </form>
</div>
@endsection

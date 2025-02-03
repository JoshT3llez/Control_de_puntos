@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Orden de Trabajo</h1>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('work_orders.update', $workOrder->orden_trabajo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="orden_trabajo">Orden de Trabajo</label>
            <input type="text" name="orden_trabajo" class="form-control" value="{{ $workOrder->orden_trabajo }}" readonly>
        </div>

        <div class="form-group">
            <label for="chofer_id">Nombre del chofer</label>
            <select name="chofer_id" class="form-control" required>
                @foreach ($choferes as $chofer)
                    <option value="{{ $chofer->id }}" {{ $workOrder->chofer_id == $chofer->id ? 'selected' : '' }}>
                        {{ $chofer->nombre }}
                    </option>
                @endforeach
            </select>
            @error('chofer_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="chofer_ot">Chofer OT</label>
            <input type="text" name="chofer_ot" class="form-control" value="{{ old('chofer_ot', $workOrder->chofer_ot) }}">
            @error('chofer_ot') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="direccion_destino">Dirección de Destino</label>
            <input type="text" name="direccion_destino" class="form-control" value="{{ old('direccion_destino', $workOrder->direccion_destino) }}" required>
            @error('direccion_destino') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="colonia_id">Colonia</label>
            <select name="colonia_id" class="form-control" required>
                @foreach ($colonias as $colonia)
                    <option value="{{ $colonia->id }}" {{ $workOrder->colonia_id == $colonia->id ? 'selected' : '' }}>
                        {{ $colonia->nombre }}
                    </option>
                @endforeach
            </select>
            @error('colonia_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="destinatario">Destinatario</label>
            <input type="text" name="destinatario" class="form-control" value="{{ old('destinatario', $workOrder->destinatario) }}">
            @error('destinatario') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="fecha_programada">Fecha Programada</label>
            <input type="date" name="fecha_programada" class="form-control" value="{{ old('fecha_programada', $workOrder->fecha_programada) }}" required>
            @error('fecha_programada') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="fecha_entrega">Fecha de Entrega</label>
            <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega', $workOrder->fecha_entrega) }}" required>
            @error('fecha_entrega') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="hora">Hora</label>
            <input type="time" name="hora" class="form-control" value="{{ old('hora', $workOrder->hora) }}">
            @error('hora') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones', $workOrder->observaciones) }}</textarea>
            @error('observaciones') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Orden</button>
    </form>
</div>
@endsection

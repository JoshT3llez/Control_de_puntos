@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Órdenes de Trabajo</h1>

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

    <a href="{{ route('work_orders.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i>Nueva Orden</a>

    <table id="work-orders-table" class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>Orden de Trabajo</th>
                <th>Nombre del Chofer</th>
                <th>Chofer_OT</th>
                <th>Dirección Destino</th>
                <th>Colonia Destino</th>
                <th>Destinatario</th>
                <th>Fecha Programada</th>
                <th>Fecha Entrega</th>
                <th>Hora</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workOrders as $order)
            <tr>
                <td>{{ $order->orden_trabajo }}</td>
                <td>{{ $order->chofer->nombre }}</td>
                <td>{{ $order->chofer_OT }}</td>
                <td>{{ $order->direccion_destino }}</td>
                <td>{{ $order->colonia->nombre }}</td>
                <td>{{ $order->destinatario }}</td>
                <td>{{ $order->fecha_programada }}</td>
                <td>{{ $order->fecha_entrega }}</td>
                <td>{{ $order->hora }}</td>
                <td>{{ $order->observaciones }}</td>
                <td>
                    <a href="{{ route('work_orders.edit', $order->orden_trabajo) }}" class="btn btn-primary btn-sm">                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('work_orders.destroy', $order->orden_trabajo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta válvula?')">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    const toggleButton = document.getElementById('toggle-dark-mode');
    const body = document.body;
    const table = document.getElementById('work-orders-table');
    const currentMode = localStorage.getItem('theme') || 'light-mode';
    body.classList.add(currentMode);

    if (currentMode === 'dark-mode') {
        toggleButton.textContent = '☀️ Modo Claro';
        toggleButton.classList.remove('btn-dark');
        toggleButton.classList.add('btn-light');
        table.classList.add('table-dark');
        table.classList.remove('table-light');
    } else {
        table.classList.add('table-light');
        table.classList.remove('table-dark');
    }

    toggleButton.addEventListener('click', () => {
        if (body.classList.contains('dark-mode')) {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');
            toggleButton.textContent = '🌙 Modo Oscuro';
            toggleButton.classList.remove('btn-light');
            toggleButton.classList.add('btn-dark');
            table.classList.add('table-light');
            table.classList.remove('table-dark');
            localStorage.setItem('theme', 'light-mode');
        } else {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');
            toggleButton.textContent = '☀️ Modo Claro';
            toggleButton.classList.remove('btn-dark');
            toggleButton.classList.add('btn-light');
            table.classList.add('table-dark');
            table.classList.remove('table-light');
            localStorage.setItem('theme', 'dark-mode');
        }
    });
</script>
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
@endsection
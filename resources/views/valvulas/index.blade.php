@extends('layouts.app')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container">
    <h1>Válvulas</h1>

    <a href="{{ route('valvulas.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Nueva Válvula</a>
    <a href="{{ route('mapa') }}" class="btn btn-primary mb-3"><i class="fas fa-map-marker-alt"></i> Ver Mapa</a>

    <table id="valvulas-table" class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>Num. Válvula</th>
                <th>Sector Comercial</th>
                <th>Sector Valvulero</th>
                <th>Ubicación</th>
                <th>Colonia/Fraccionamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($valvulas as $valvula)
            <tr> 
                <td>{{ $valvula->numero_valvula }}</td>
                <td>{{ $valvula->sectorComercial->nombre ?? 'Sin asignar' }}</td>
                <td>{{ $valvula->sectorValvulero->nombre ?? 'Sin asignar' }}</td>                
                <td>{{ $valvula->ubicacion }}</td>
                <td>{{ $valvula->colonia_fraccionamiento }}</td>
                <td>
                    <a href="{{ route('valvulas.show', $valvula->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('valvulas.edit', $valvula->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('valvulas.destroy', $valvula->id) }}" method="POST" class="d-inline form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                    <a href="{{ route('valvulas.exportPDF', $valvula->id) }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $valvulas->links() }}
</div>

<!-- Mostrar mensaje de éxito o error -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#28a745'
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session("error") }}',
            confirmButtonColor: '#dc3545'
        });
    </script>
@endif

<script>
    const toggleButton = document.getElementById('toggle-dark-mode');
    const body = document.body;
    const table = document.getElementById('valvulas-table');
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

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let form = this.closest('form');
            let numeroValvula = form.closest('tr').querySelector('td').innerText;  // Obtener el número de la válvula

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Eliminando...',
                        text: `La válvula ${numeroValvula} será eliminada.`,
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 5000,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Esperar unos segundos antes de enviar el formulario
                    setTimeout(() => {
                        form.submit();
                    }, 5000);
                }
            });
        });
    });
</script>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@endsection

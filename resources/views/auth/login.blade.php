<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="row g-0">
                        <!-- Sección para imagen -->
                        <div class="col-md-5 d-none d-md-block">
                            <img src="{{ asset('images/LOGO.jpeg') }}" alt="Login Image" class="img-fluid rounded-start">
                        </div>
                        
                        <!-- Sección para formulario -->
                        <div class="col-md-7">
                            <div class="card-body p-4">
                                <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                    </div>
                                </form>
                                <p class="text-center">
                                    ¿No tienes una cuenta? 
                                    <a href="{{ route('register') }}" class="text-decoration-none">Regístrate aquí</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 3500
        });
    </script>
    @endif
    
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3500
        });
    </script>
    @endif
    
</body>
</html>

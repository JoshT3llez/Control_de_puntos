<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
                        <img src="{{ asset('images/LOGO.jpeg') }}" alt="Register Image" class="img-fluid rounded-start">
                    </div>
                  
                    <!-- Sección para formulario -->
                    <div class="col-md-7">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">{{ __('Registro') }}</h3>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Correo Electronico') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">{{ __('Confirmar contraseña') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </form>
                            <p class="text-center">
                                ¿Ya tienes una cuenta? 
                                <a href="{{ route('login') }}" class="text-decoration-none">Inicia sesión aquí</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Errores en el formulario',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        showConfirmButton: false,
        timer: 3500
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Registro exitoso!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 3500
    });
</script>
@endif

</body>
</html>

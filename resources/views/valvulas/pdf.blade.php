<head>
    <meta charset="UTF-8">
    <title>Válvula {{ $valvula->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }

        h1 {
            color: #333;
            font-size: 24px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .details strong {
            color: #555;
        }

        .map-container {
            text-align: center;
            margin-top: 20px;
        }

        .map-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>Detalles de la Válvula #{{ $valvula->numero_valvula }}</h1>

    <div class="details">
        <p><strong>Sector Comercial:</strong> {{ $valvula->sector_comercial }}</p>
        <p><strong>Sector Valvulero:</strong> {{ $valvula->sector_valvulero }}</p>
        <p><strong>Ubicación:</strong> {{ $valvula->ubicacion }}</p>
        <p><strong>Colonia/Fraccionamiento:</strong> {{ $valvula->colonia_fraccionamiento }}</p>
        <p><strong>Observaciones:</strong> {{ $valvula->observacion }}</p>
        <p><strong>coordenadas:</strong>altitud:{{$valvula->altitud}} y longitud:{{$valvula->longitud}}</p>
    </div>
    
</body>

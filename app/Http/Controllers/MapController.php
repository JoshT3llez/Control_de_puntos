<?php
namespace App\Http\Controllers;

use App\Models\Valvulas;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $valvulas = Valvulas::with(['sectorComercial', 'sectorValvulero'])->get();
    
        $ubicaciones = $valvulas->map(function ($valvula) {
            return [
                'lat' => $valvula->altitud,
                'lng' => $valvula->longitud,
                'nombre' => "
                    <strong>Válvula:</strong> {$valvula->numero_valvula} <br>
                    <strong>Sector Comercial:</strong> " . ($valvula->sectorComercial->nombre ?? 'No asignado') . "<br>
                    <strong>Sector Valvulero:</strong> " . ($valvula->sectorValvulero->nombre ?? 'No asignado') . "<br>
                    <a href='https://www.google.com/maps?q={$valvula->altitud},{$valvula->longitud}' target='_blank'>
                        Ver en Google Maps
                    </a>
                ",
            ];
        });
    
        return view('mapa', compact('ubicaciones'));
    }
    
}

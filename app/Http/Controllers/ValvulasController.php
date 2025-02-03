<?php

namespace App\Http\Controllers;

use App\Models\Valvulas;
use App\Models\SectorComercial;
use App\Models\SectorValvulero;

use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ValvulasController extends Controller
{
    // Método para generar el reporte en PDF
    public function generatePDF()
    {
        $valvulas = Valvulas::all();
        $pdf = PDF::loadView('valvulas.reporte', compact('valvulas'));
        return $pdf->download('reporte_valvulas.pdf');
    }

    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 25);  // Valor predeterminado 25

        // Obtener las válvulas con paginación
        $valvulas = Valvulas::with(['sectorComercial', 'sectorValvulero'])->paginate(10);
    
        return view('valvulas.index', compact('valvulas'));
    }

    public function create()
    {
        $sector_comercials = SectorComercial::all();
        $sector_valvuleros = SectorValvulero::all();
    
        return view('valvulas.create', compact('sector_comercials', 'sector_valvuleros'));
    }
    

    public function store(Request $request)
    {

        $request->validate([
            'numero_valvula' => 'required',
            'estado' => 'required',
            'altitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'colonia_fraccionamiento' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'tipo' => 'required',
            'sector_comercial_id' => 'required|exists:sector_comercials,id',
            'sector_valvulero_id' => 'required|exists:sector_valvuleros,id',
            'diametro_valvula' => 'required',
            'condicion' => 'required',
            'observacion' => 'nullable|string',
        ]);
        
        Valvulas::create($request->all()); // Crear la válvula

        return redirect()->route('valvulas.index')->with('success', 'La válvula ha sido creada correctamente.');
    }

    public function show($id)
    {
        $valvula = Valvulas::with(['sectorComercial', 'sectorValvulero'])->findOrFail($id);
        return view('valvulas.show', compact('valvula'));
    }

    public function edit($id)
    {
        $valvula = Valvulas::findOrFail($id); // Obtener la válvula para editar
        return view('valvulas.edit', compact('valvula'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_valvula' => 'required',
            'estado' => 'required',
            'altitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'tipo' => 'required',
            'sector_comercial' => 'required',
            'sector_valvulero' => 'required',
            'diametro_valvula' => 'required',
            'colonia_fraccionamiento' => 'required',
            'ubicacion' => 'required',
            'condicion' => 'required',
            'observacion' => 'required',
        ]);

        $valvula = Valvulas::findOrFail($id);
        $valvula->update($request->all()); // Actualizar la válvula

        return redirect()->route('valvulas.index')->with('success', '¡Válvula actualizada correctamente!');
    }

    public function destroy($id)
    {
        $valvula = Valvulas::findOrFail($id);
        $numeroValvula = $valvula->numero_valvula; // Obtener el número de la válvula antes de eliminarla
        $valvula->delete(); // Eliminar la válvula
    
        // Para la eliminación
        return redirect()->route('valvulas.index')->with('success', "Válvula #$numeroValvula eliminada con éxito.");
    }

    public function exportPDF($id)
    {
        $valvula = Valvulas::findOrFail($id);

        // Generar PDF
        $pdf = Pdf::loadView('valvulas.pdf', compact('valvula'));
        return $pdf->download('valvula_' . $id . '.pdf');
    }
}

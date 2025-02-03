<?php

namespace App\Http\Controllers;
use App\Models\WorkOrder;
use App\Models\Chofer;
use App\Models\Colonia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkOrderController extends Controller
{
    public function index()
    {
        $workOrders = WorkOrder::with(['chofer', 'colonia'])->get();
        return view('work_orders.index', compact('workOrders'));  

}

    public function create(){
        $choferes = Chofer::all();
        $colonias = Colonia::all();
        $colonias = Colonia::orderBy('nombre', 'asc')->get();

        return view('work_orders.create', compact('choferes', 'colonias'));
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

    public function edit($orden_trabajo){
        $workOrder = WorkOrder::where('orden_trabajo', $orden_trabajo)->first();
        $colonias = Colonia::orderBy('nombre', 'asc')->get();

        if (!$workOrder) {
            return redirect()->route('work_orders.index')->with('error', 'Orden de trabajo no encontrada.');
        }
        
        $choferes = Chofer::all();
        $colonias = Colonia::all();
    
        return view('work_orders.edit', compact('workOrder', 'choferes', 'colonias'));
    }
    

    public function update(Request $request, $orden_trabajo)
    {
        $validated = $request->validate([
            'nombre_chofer' => 'required|string|max:255',
            'chofer_ot' => 'required|string|max:255',
            'direccion_destino' => 'required|string|max:255',
            'colonia_id' => 'required|exists:colonias,id',
            'destinatario' => 'nullable|string|max:255',
            'fecha_programada' => 'required|date',
            'fecha_entrega' => 'required|date',
            'hora' => 'nullable|date_format:H:i',
            'observaciones' => 'nullable|string',
        ]);
    
        $workOrder = WorkOrder::where('orden_trabajo', $orden_trabajo)->first();
    
        if (!$workOrder) {
            return redirect()->route('work_orders.index')->with('error', 'Orden de trabajo no encontrada.');
        }
    
        $workOrder->update($validated);
    
        return redirect()->route('work_orders.index')->with('success', 'Orden de trabajo actualizada exitosamente.');
    }
    
    
    
    public function destroy($orden_trabajo)
    {
        $workOrder = WorkOrder::where('orden_trabajo', $orden_trabajo)->first();
    
        if ($workOrder) {
            $workOrder->delete();
            return redirect()->route('work_orders.index')->with('success', 'Orden de trabajo eliminada exitosamente.');
        } else {
            return redirect()->route('work_orders.index')->with('error', 'Orden de trabajo no encontrada.');
        }
    }
    
    
    
}


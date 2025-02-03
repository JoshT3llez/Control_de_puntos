<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $fillable = [
        'orden_trabajo',
        'chofer_id',
        'colonia_id',
        'direccion_destino',
        'destinatario',
        'fecha_programada',
        'fecha_entrega',
        'hora',
        'observaciones',
    ];
    protected $primaryKey = 'orden_trabajo'; // Especifica que la clave primaria es 'orden_trabajo'

    public function sectorComercial()
    {
        return $this->belongsTo(SectorComercial::class, 'sector_comercial_id');
    }
    
    public function sectorValvulero()
    {
        return $this->belongsTo(SectorValvulero::class, 'sector_valvulero_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valvulas extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_valvula',
        'estado',
        'altitud',
        'longitud',
        'colonia_fraccionamiento',
        'ubicacion',
        'tipo',
        'sector_comercial',
        'sector_valvulero',
        'diametro_valvula',
        'condicion',
        'observacion',
    ];

    public function sectorComercial()
    {
        return $this->belongsTo(SectorComercial::class);
    }

    public function sectorValvulero()
    {
        return $this->belongsTo(SectorValvulero::class);
    }
}

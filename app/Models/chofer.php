<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{

    use HasFactory;

    protected $table = 'choferes'; // Nombre correcto de la tabla

    protected $fillable = ['nombre_chofer', 'chofer_ot'];

    // Relación con WorkOrder
    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class, 'chofer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    protected $fillable = ['nombre'];

    // Relación con WorkOrder
    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class, 'colonia_id');
    }
}

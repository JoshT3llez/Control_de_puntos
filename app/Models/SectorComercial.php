<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectorComercial extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function valvulas()
    {
        return $this->hasMany(Valvulas::class);
    }
}

<?php

namespace App\Exports;

use App\Models\Valvulas;
use Maatwebsite\Excel\Concerns\FromCollection;

class ValvulasExport implements FromCollection
{
    /**
     * Obtener todos los registros de la base de datos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Obtén todos los registros de la tabla `valvulas`
        return Valvulas::all();
    }
}

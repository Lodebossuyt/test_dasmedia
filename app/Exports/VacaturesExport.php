<?php

namespace App\Exports;

use App\Models\Vacature;
use Maatwebsite\Excel\Concerns\FromCollection;

class VacaturesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Vacature::all()->map(function ($vacature) {
            return [
                $vacature->id,
                $vacature->title,
                $vacature->company->name,
            ];
        });
    }
}

<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudent implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function array(): array
    {
        return [];
    } 


    // public function collection()
    // {
    //     return Student::all();
    // }

    public function headings(): array
    {
        return [
            'Name of Student',
            'Gender',
            'Stream',
            'Finishing Year'
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;




class ExportStudent implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    private $school_id;

    /**
     * @param $school_id
     */
    public function __construct($school_id)
    {
        $this->school_id = $school_id;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name of Student',
            'Gender',
            'Stream',
            'Grade'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row (headers)
            1 => [
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D3D3D3']]
            ]
        ];
    }

    public function query()
    {
        return Student::query()
            ->select('id', 'student_name', 'gender', 'school_id', 'stream_id', 'final_year_id')
            ->where('school_id', $this->school_id);

    }

    public function map($student): array
    {
        static $index = 0;
        $grade = '';
        if ($student->school->educationLevel == 'Primary') {
            $grade = $student->Primary($this->school_id);
        } else {
            $grade = $student->Secondary($this->school_id);
        }

        return [
            ++$index,
            $student->student_name,
            $student->gender,
            $student->stream->name,
            $grade
        ];
    }
}

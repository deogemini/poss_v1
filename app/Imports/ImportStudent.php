<?php

namespace App\Imports;

use App\Models\FinalYears;
use App\Models\Stream;
use App\Models\Student;
use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
HeadingRowFormatter::default('none');


class ImportStudent implements ToModel, WithHeadingRow
{


    private $school_id;

    /**
     * @param $school_id
     */
    public function __construct($school_id)
    {
        $this->school_id = $school_id;
    }

    public function model(array $rows)
    {
        // Look up the stream_id based on the stream name
        $stream = Stream::where('name', $rows['Stream'])->first();
        $stream_id = $stream ? $stream->id : null;

        // Convert gender value to lowercase
        $gender = strtolower($rows['Gender']);


        // Calculate the final year based on the provided grade class and school's education level
        $educationLevel = School::where('id', $this->school_id)->value('educationLevel');

        switch ($educationLevel) {
            case 'Primary':
                $nameToValue = [
                    'Standard One' => 1,
                    'Standard Two' => 2,
                    'Standard Three' => 3,
                    'Standard Four' => 4,
                    'Standard Five' => 5,
                    'Standard Six' => 6,
                    'Standard Seven' => 7,
                ];

                $yearOffset = 7 - $nameToValue[$rows['Grade']];
                break;
            case 'Secondary':
                $nameToValue = [
                    'Form One' => 1,
                    'Form Two' => 2,
                    'Form Three' => 3,
                    'Form Four' => 4,
                ];
                $yearOffset = 4 - $nameToValue[$rows['Grade']];
                break;
            default:
                $yearOffset = 0;
                break;
        }

        $finalYear = (int) date('Y') + $yearOffset;

        // Look up the final year ID based on the calculated year
        $final_year = FinalYears::where('year', $finalYear)->first();
        $final_year_id = $final_year ? $final_year->id : null;

        $student =  new Student([
            'student_name' => $rows['Name of Student'],
            'gender' => $gender,
            'stream_id' => $stream_id,
            'school_id' => $this->school_id,
            'final_year_id' => $final_year_id
        ]);
       $student->setCreatedAt(null);
       $student->setUpdatedAt(null);

       return $student;

    }

}

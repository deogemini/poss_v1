<?php

namespace App\Imports;

use App\Models\FinalYears;
use App\Models\Stream;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportStudent implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection(Collection $rows)
    {

             foreach ($rows as $row) {

            DB::beginTransaction();

            $stream = Stream::where("name", "=",$row['stream'])->first();

            $finalYear = FinalYears::where("year", "=", $row['year'])->first();


            if($finalYear == null){

                $finalYear =  FinalYears::create([

                        'year' => $row['year'],
                    ]);
            }

            if($stream == null){

            

                    $stream =  Stream::create([

                        'name' => $row['stream'],
                    ]);
                
            }

            $student = new Student();
            $student->student_name = $row['name'];
            $student->gender = $row['gender'];
            $student->stream_id = $stream->id;
            $student->final_year_id = $finalYear->id;
            $student->school_id = 1;


            $student->save();

            DB::commit();

        }

    }

}

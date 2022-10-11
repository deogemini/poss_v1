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

class ImportStudent implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function model(array $rows)
    {

             foreach ($rows as $row) {

            DB::beginTransaction();

            $stream = Stream::where("name",$row[3])->first();

            $finalYear = FinalYears::where("year", $row[4])->first();


            if($finalYear == null){

                $finalYear =  FinalYears::create([

                        'year' => $row[4],
                    ]);
            }

            if($stream == null){

            

                    $stream =  Stream::create([

                        'name' => $row[3],
                    ]);
                
            }

            $student = new Student();
            $student->student_name = $row[1];
            $student->gender = $row[2];
            $student->stream_id = $stream->id;
            $student->final_year_id = $finalYear->id;
            $student->school_id = 1;


            $student->save();

            DB::commit();

        }

    }

}

<?php

namespace App\Imports;

use App\Models\Exercise;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ExerciseImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row = $row->toArray();
        $data = [
            'title' => $row[0],
            'slug' => $row[1], 
            'content' => $row[2],
            'subject_id' => $row[3],
        ];
        dd($data);
    }
}
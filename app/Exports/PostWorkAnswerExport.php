<?php

namespace App\Exports;

use App\Models\postWorkAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostWorkAnswerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return postWorkAnswer::all();
    }
}

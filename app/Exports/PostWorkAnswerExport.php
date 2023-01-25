<?php

namespace App\Exports;

use App\Models\postWorkAnswer;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class PostWorkAnswerExport implements FromView, ShouldAutoSize
{
    use Exportable;
    protected $excelTest;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->excelTest = $id;
    }

    public function view(): View
    {
        $formAnswer = postWorkAnswer::where('id_postWork',$this->excelTest)->first();
        $teste = json_decode($formAnswer->form_array,true);
        $array = $teste[0]['Themes'];
        return view('exports.excel',[
            "form" => $array
        ]);
        //return user::get();
    }
}

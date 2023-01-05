<?php

namespace App\Http\Controllers;

use App\Models\answer;
use App\Models\cr;
use App\Models\form;
use App\Models\formTheme;
use App\Models\question;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class CompletedFormsController extends Controller
{
    public function store($id, Request $request)
    {
        $forms = form::findOrFail($id);
        $formThemes = formTheme::where('id_form',$id)->get();
        $questions = question::where('id_formTheme',$id)->get();
        $answers = answer::where('id_question',$id)->get();
        //return form::with('formThemes')->get();
        $dados = form::with('formThemes')->get();
        return $dados;
    }
}
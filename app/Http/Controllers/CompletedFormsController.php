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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $forms = form::where('id', $id)->first();
        $formThemes = formTheme::where('id_form',$id);
        $questions = question::where('id_formTheme',$id);
        $answers = answer::where('id_question',$id);
        if($forms){
            $arr = array([
                'form' => $forms->name,
                'form_theme' => $formThemes->theme,
                'question' => $questions->question,
                'answerType' => $questions->answerType,
                'answer' => $answers->answer
            ]);
            try{
                if ($formThemes) {
                    return $arr;
                }
        }catch (ClientException $e) {
            return $e->getResponse();
        };
    }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}

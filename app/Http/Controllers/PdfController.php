<?php

namespace App\Http\Controllers;

use App\Models\form;
use App\Models\postWork;
use App\Models\postWorkAnswer;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $formAnswer = postWorkAnswer::where('id_postWork',$id)->first();
        $convertido = json_encode($formAnswer->form_array);
        $teste = json_decode($formAnswer->form_array,true);
        $array = $teste[0];
        //$data= json_decode($convertido);
        //$ref = postWorkAnswer::where('id_postWork',$id)->first();
        /*
            @foreach (json_decode($array['Themes'],true) as $forms)
    <h2>{{$forms[0]}}</h2><br>
    @endforeach
        */
        //Base64 teste json_decode(

        // if($form){
            //$ref = postWork::findOrFail($id)->first()->id_form;
            //$pdf = form::findOrFail($ref)->with('postWorkAnswer')->get();
        // }
        $pdf = PDF::loadView('pdf', compact('array'));
        return $pdf->setPaper('a4')->stream('Formulário');
      // return $array['Themes']->length;

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
    public function store(Request $request)
    {
        //
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

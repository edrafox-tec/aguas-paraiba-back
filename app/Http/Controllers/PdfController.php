<?php

namespace App\Http\Controllers;

use App\Models\assing;
use App\Models\form;
use App\Models\User;
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
        $formAnswer = postWorkAnswer::where('id_postWork', $id)->first();
        $PostWork = postWork::where('id', $formAnswer->id_postWork)->first();
        $user = user::where('id', $PostWork->id_user)->withTrashed()->first();
        $convertido = json_encode($formAnswer->form_array);
        $teste = json_decode($formAnswer->form_array, true);
        $formulario = form::where('id',$PostWork->id_form)->first();
        //dd($PostWork->id);
        $assing = assing::where('postworkAnswer',$PostWork->id)->get();
        //dd($assing);
        //dd($formulario['sing_fiscal']);
        $array = $teste[0]['Themes'];
        //return $array;
        if (count($array) > 0) {
            $title = $teste[0]['Form'];
            $pdf = PDF::loadView('pdf', compact('array', 'title', 'user','formulario','formAnswer','assing'));
            return $pdf->setPaper('a4')->download($PostWork->created_at.'_'.$user->function .'_'.$title.'_'.$user->nickname . '.pdf');
        } else {
            return 'Formulário corrompido';
        }
        //return 'ola mundo 8';
    }
    public function indexBase64($id, Request $request)
    {
        $formAnswer = postWorkAnswer::where('id_postWork', $id)->first();
        $PostWork = postWork::where('id', $formAnswer->id_postWork)->first();
        $user = user::where('id', $PostWork->id_user)->withTrashed()->first();
        $convertido = json_encode($formAnswer->form_array);
        $teste = json_decode($formAnswer->form_array, true);
        $formulario = form::where('id',$PostWork->id_form)->first();
        //dd($formulario['sing_fiscal']);
        $array = $teste[0]['Themes'];
        //return $array;
        if (count($array) > 0) {
            $title = $teste[0]['Form'];
            $pdf = PDF::loadView('pdf', compact('array', 'title', 'user','formulario','formAnswer'));
            $file = $pdf->setPaper('a4')->download($title . '-' . $user->name . '.pdf');
            $pdfView = chunk_split(base64_encode($file));
            $arr = [];
            array_push(
                $arr,
                array(
                    'base64' => 'data:application/pdf;base64,' . $pdfView
                )
            );
            return $arr;
        } else {
            return ["Formulário corrompido"];
        }
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

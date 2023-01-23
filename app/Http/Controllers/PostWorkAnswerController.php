<?php

namespace App\Http\Controllers;

use App\Exports\PostWorkAnswerExport;
use App\Models\postWorkAnswer;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Excel;

class PostWorkAnswerController extends Controller
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
    public function create(Request $request)
    {
        $postWorkAnswer = new postWorkAnswer;
        $postWorkAnswer->id_postWork = $request->input('id_postWork');
        $postWorkAnswer->form_array = $request->input('form_array');
        try {
            if ($postWorkAnswer->save()) {
                return $postWorkAnswer;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $postWorkAnswer = postWorkAnswer::where('id', $id)->first();
        if (!$postWorkAnswer) {
            return 'Nenhum postWorkAnswer encontrado!';
        } else {
            return $postWorkAnswer;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $postWorkAnswer = postWorkAnswer::get();
        return $postWorkAnswer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(postWorkAnswer $postWorkAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $postWorkAnswer = postWorkAnswer::findOrFail($id);
        $postWorkAnswer->answer = $request->input('answer');
        $postWorkAnswer->id_postWork = $request->input('id_postWork');
        $postWorkAnswer->id_question = $request->input('id_question');
        $postWorkAnswer->id_answer = $request->input('id_answer');
        try {
            if ($postWorkAnswer->save()) {
                return $postWorkAnswer;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = postWorkAnswer::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }

    public function export() 
    {
        return Excel::download(new PostWorkAnswerExport, 'PostWorkAnswer.xlsx');
    }
}

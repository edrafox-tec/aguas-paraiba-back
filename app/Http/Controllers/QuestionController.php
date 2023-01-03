<?php

namespace App\Http\Controllers;

use App\Models\question;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $question = new question;
        $question->question = $request('question');
        $question->answerType = $request('answerType');
        $question->description = $request('description');
        $question->id_formTheme = $request('id_formTheme');
        try {
            if($question->save()){
                return $question;
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
        $question = question::where('id', $id)->first();
        if (!$question) {
            return 'Nenhum question encontrado!';
        } else {
            return $question;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $question = question::get();
        return $question;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $question = question::findOrFail($id);
        $question->question = $request->input('question');
        $question->answerType = $request->input('answerType');
        $question->description = $request->input('description');
        $question->id_formTheme = $request->input('id_formTheme');
        try {
            if ($question->save()) {
                return $question;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = question::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

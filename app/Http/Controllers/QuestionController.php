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
        $questions = new question;
        $questions->question = $request->input('question');
        $questions->answerType = $request->input('answerType');
        $questions->description = $request->input('description');
        $questions->id_formTheme = $request->input('id_formTheme');
        $questions->required = $request->input('required');
        try {
            if ($questions->save()) {
                return $questions;
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
        $questions = question::where('id', $id)->first();
        if (!$questions) {
            return 'Nenhum question encontrado!';
        } else {
            return $questions;
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
        $questions = question::get();
        return $questions;
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
        $questions = question::findOrFail($id);
        $questions->question = $request->input('question');
        $questions->answerType = $request->input('answerType');
        $questions->description = $request->input('description');
        $questions->id_formTheme = $request->input('id_formTheme');
        $questions->required = $request->input('required');
        try {
            if ($questions->save()) {
                return $questions;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
    public function position(Request $request){
        $questionPosition = question::where($request->input('id'),'id')->first();
        $questionPosition->position = $request->input('position');
        try {
            if ($questionPosition->save()) {
                return $questionPosition;
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

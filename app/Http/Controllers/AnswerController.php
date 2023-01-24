<?php

namespace App\Http\Controllers;

use App\Models\answer;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class AnswerController extends Controller
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
        $answer = new answer;
        $answer->answer = $request->input('answer');
        $answer->description = $request->input('description');
        $answer->id_question = $request->input('id_question');
        try {
            if($answer->save()){
                return $answer;
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
        $answer = answer::where('id', $id)->first();
        if (!$answer) {
            return response()->json([
                'message' => 'answer not found'
            ], 404);
        } else {
            return $answer;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $answer = answer::get();
        return $answer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $answer = answer::findOrFail($id);
        $answer->answer = $request->input('answer');
        $answer->description = $request->input('description');
        $answer->id_question = $request->input('id_question');
        try {
            if($answer->save()){
                return $answer;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = answer::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

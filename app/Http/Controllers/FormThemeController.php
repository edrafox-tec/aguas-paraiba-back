<?php

namespace App\Http\Controllers;

use App\Models\formTheme;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class FormThemeController extends Controller
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
        $formTheme = new FormTheme;
        $formTheme->name = $request->name;
        $formTheme->description = $request->description;
        $formTheme->id_form = $request->input('id_form');
        try {
            if ($formTheme->save()) {
                return $formTheme;
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
        $formTheme = formTheme::where('id', $id)->first();
        if (!$formTheme) {
            return 'Nenhum formTheme encontrado!';
        } else {
            return $formTheme;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\formTheme  $formTheme
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $formTheme = formTheme::get();
        return $formTheme;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\formTheme  $formTheme
     * @return \Illuminate\Http\Response
     */
    public function edit(formTheme $formTheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\formTheme  $formTheme
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $formTheme = formTheme::findOrFail($id);
        $formTheme->theme = $request->input('theme');
        $formTheme->description = $request->input('description');
        $formTheme->id_form = $request->input('id_form');
        try {
            if ($formTheme->save()) {
                return $formTheme;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\formTheme  $formTheme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = formTheme::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

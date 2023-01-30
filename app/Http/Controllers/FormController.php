<?php

namespace App\Http\Controllers;

use App\Models\form;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class FormController extends Controller
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
        $form = new form;
        $form->name = $request->input('name');
        $form->description = $request->input('description');
        $form->id_sector = $request->input('id_sector');
        try {
            if ($form->save()) {
                return $form;
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
        $form = form::where('id', $id)->first();
        if (!$form) {
            return 'Nenhum form encontrado!';
        } else {
            return $form;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\form  $form
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $form = form::get();
        return $form;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\form  $form
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $form = form::findOrFail($id);
        $form->name = $request->input('name');
        $form->description = $request->input('description');
        $form->id_sector = $request->input('id_sector');
        try {
            if ($form->save()) {
                return $form;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = form::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

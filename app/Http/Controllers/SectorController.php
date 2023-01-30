<?php

namespace App\Http\Controllers;

use App\Models\sector;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class SectorController extends Controller
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
        $sector = new sector;
        $sector->name = $request->input('name');
        $sector->level = $request->input('level');
        $sector->description = $request->input('description');
        try {
            if ($sector->save()) {
                return $sector;
            };
        } catch (ClientException $e) {
            return $e->getResponse();
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
        $sector = sector::where('id', $id)->first();
        if (!$sector) {
            return response()->json([
                'message' => 'Sector not found'
            ], 404);
        } else {
            return $sector;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $sector = sector::get();
        return $sector;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $sector = sector::find($id);
        if (!$sector) {
            return response()->json([
                'message' => 'Sector not found'
            ], 404);
        } else {
            $sector->name = $request->input('name');
            $sector->level = $request->input('level');
            $sector->description = $request->input('description');
            try {
                if ($sector->save()) {
                    return $sector;
                }
            } catch (ClientException $e) {
                return $e->getResponse();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = sector::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

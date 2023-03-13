<?php

namespace App\Http\Controllers;

use App\Models\assing;
use Illuminate\Http\Request;

class AssingController extends Controller
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
    public function store(Request $request)
    {
        $forms = assing::where('user_id', $request->input('user_id'))->where('signed',0)->with('form')->get();
        return $forms;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\assing  $assing
     * @return \Illuminate\Http\Response
     */
    public function show(assing $assing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\assing  $assing
     * @return \Illuminate\Http\Response
     */
    public function edit(assing $assing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\assing  $assing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assing $assing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\assing  $assing
     * @return \Illuminate\Http\Response
     */
    public function destroy(assing $assing)
    {
        //
    }
}

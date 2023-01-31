<?php

namespace App\Http\Controllers;

use App\Models\postWork;
use App\Models\postWorkAnswer;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class PostWorkController extends Controller
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
        $postWork = new PostWork();
        $postWork->id_sector = $request->input('id_sector');
        $postWork->id_form = $request->input('id_form');
        $postWork->id_user = $request->input('id_user');
        $postWork->conformity = $request->input('conformity');
        try {
            if ($postWork->save()) {
                return $postWork;
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
        $postWork = postWork::where('id', $id)->first();
        if (!$postWork) {
            return 'Nenhum postWork encontrado!';
        } else {
            return $postWork;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postWork  $postWork
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $postWork = postWork::get();
        return $postWork;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postWork  $postWork
     * @return \Illuminate\Http\Response
     */
    public function edit(postWork $postWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postWork  $postWork
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $postWork = postWork::findOrFail($id);
        $postWork->id_sector = $request->input('id_sector');
        $postWork->id_form = $request->input('id_form');
        $postWork->id_user = $request->input('id_user');
        $postWork->conformity = $request->input('conformity');
        try {
            if ($postWork->save()) {
                return $postWork;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postWork  $postWork
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postWork = PostWork::find($id);
        $postWorkAnswers = postWorkAnswer::where('id_postWork', $id)->get();

        if ($postWorkAnswers->count() > 0) {
            foreach ($postWorkAnswers as $postWorkAnswer) {
                $postWorkAnswer->delete();
            }
        }

        $postWork->delete();

        return redirect()->back();
    }
}

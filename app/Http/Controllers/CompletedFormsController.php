<?php

namespace App\Http\Controllers;

use App\Models\form;
use App\Models\formTheme;
use App\Models\postWork;
use App\Models\postWorkAnswer;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompletedFormsController extends Controller
{
    public function store($id, Request $request) //Adm
    {
        return form::where('id', $id)->with('formThemes')->get();
    }

    public function show($id, Request $request) //Adm
    {
        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->get();
    }

    public function perDate(Request $request) //Adm
    {
        $inicio = $request->input('initial_date');
        $fim = $request->input('final_date');

       // $ref = postWork::where('id', $id)->first()->id_form;
       if($inicio != $fim){
           return postWork::with('form')->whereBetween('created_at', [$inicio, $fim])->get();
       }else{
           return postWork::with('form')->where('created_at', $inicio)->get();
       }
    }

    public function perSector($id, Request $request) //Adm
    {
        $sector = $request->input('id_sector');
        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->where('id_sector', $sector)->get();
    }
    //Rota para usuario

    public function storeUser($id_user, Request $request)
{
    $postWorks = postWork::where('id_user', $id_user)
        ->join('forms', 'post_works.id_form', '=', 'forms.id')
        ->select('post_works.*', 'forms.*')
        ->get();

    return $postWorks->toArray();
}



    public function showUser($id, Request $request)
    {
        // $user  = $request->input('id_user');
        $ref = postWorkAnswer::where('id_postWork', $id)->first();
        // $test = form::findOrFail($ref)->with('postWorkAnswer')->get();
        return $ref->toArray(); //->where('id_user', $user)->get();
    }
    public function allAnswer()
    {
        $ref = postWork::with('form')->get();
        return $ref; //->where('id_user', $user)->get();
    }

    public function perDateUser($id, Request $request) //Adm
    {
        $inicio = $request->input('initial_date');
        $fim = $request->input('final_date');
        $user  = $request->input('id_user');

        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->whereBetween('created_at', [$inicio, $fim])->where('id_user', $user)->get();
    }

    public function perSectorUser($id, Request $request)
    {
        $user  = $request->input('id_user');
        $sector = $request->input('id_sector');
        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->where('id_sector', $sector)->where('id_user', $user)->get();
    }

    public function filter(Request $request)
    {
        $created_at_start = $request->input('created_at_start');
        $created_at_end = $request->input('created_at_end');
        $conformity = $request->input('conformity');

        $ref = postWork::with('form')->whereBetween('created_at', [$created_at_start, $created_at_end])->where('conformity', $conformity)->get();
        return $ref;
    }

    public function postWorkBySector(Request $request)
{
    $id_sector = $request->input('id_sector');

    $postWork = DB::table('post_works')
        ->join('forms', 'post_works.id_form', '=', 'forms.id')
        ->select('post_works.*', 'forms.*')
        ->where('post_works.id_sector', $id_sector)
        ->where('conformity', null)
        ->get();

    return $postWork;
}
}

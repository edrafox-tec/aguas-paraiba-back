<?php

namespace App\Http\Controllers;

use App\Models\form;
use App\Models\formTheme;
use App\Models\postWork;
use App\Models\postWorkAnswer;
use App\Models\question;
use Illuminate\Http\Request;

class CompletedFormsController extends Controller
{
    public function store($id, Request $request)//Adm
    {
        return form::findOrFail($id)->with('formThemes')->get();
    }

    public function show($id, Request $request) //Adm
    {
        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->get();
    }

    public function perDate($id, Request $request)//Adm
    {
        $inicio = $request->input('initial_date');
        $fim = $request->input('final_date');

        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->whereBetween('created_at', [$inicio, $fim])->get();
    }

    public function perSector($id, Request $request)//Adm
    {
        $sector = $request->input('id_sector');
        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->where('id_sector', $sector)->get();
    }
    //Rota para usuario

    public function storeUser($id, Request $request)
    {
        $formsList = postWork::where('id_user',$id)->with('form')->get();
        return $formsList;
    }

    public function showUser($id, Request $request)
    {
       // $user  = $request->input('id_user');
       $ref = postWork::where('id',$id)->first()->id_form;
       return form::findOrFail($ref)->with('postWorkAnswer')->first();//->where('id_user', $user)->get();
    }

    public function perDateUser($id, Request $request)//Adm
    {
        $inicio = $request->input('initial_date');
        $fim = $request->input('final_date');
        $user  = $request->input('id_user');

        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->whereBetween('created_at', [$inicio, $fim])->where('id_user', $user)->get();
    }

    public function perSectorUser($id, Request $request)
    {
        $user  = $request->input('id_user');
        $sector = $request->input('id_sector');
        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->where('id_sector', $sector)->where('id_user', $user)->get();
    }
}
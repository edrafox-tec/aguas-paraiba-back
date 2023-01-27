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

    public function perDate($id, Request $request) //Adm
    {
        $inicio = $request->input('initial_date');
        $fim = $request->input('final_date');

        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->whereBetween('created_at', [$inicio, $fim])->get();
    }

    public function perSector($id, Request $request) //Adm
    {
        $sector = $request->input('id_sector');
        $ref = postWork::where('id', $id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->where('id_sector', $sector)->get();
    }
    //Rota para usuario

    public function storeUser($id, Request $request)
    {
        $formsList = postWork::where('id_user', $id)->with('form')->get();
        return $formsList;
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
        $query = postWorkAnswer::query();

        if ($request->has('created_at_start') && $request->has('created_at_end')) {
            $query->whereBetween('created_at', [
                $request->input('created_at_start'),
                $request->input('created_at_end')
            ]);
        }

        if ($request->has('conformity')) {
            $query->where('conformity', $request->input('conformity'));
        }
        //$query = $query->toSql();
        //dd($query);
        $results = $query->get();

        return $results;
    }

    public function postWorkBySector(Request $request)
    {
        $id_sector = $request->input('id_sector');
        $postWork = DB::table('post_works')
            ->where('id_sector', $id_sector)
            ->join('post_work_answers', 'post_work_answers.id_postWork', '=', 'id_postWork')
            ->where('post_work_answers.conformity', 0)
            ->get();
        return $postWork;
    }
}

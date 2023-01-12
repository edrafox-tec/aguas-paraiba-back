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
    public function store($id, Request $request)
    {
        return form::findOrFail($id)->with('formThemes')->get();
    }

    public function show($id, Request $request) 
    {
        return postWork::findOrFail($id)->with('postWorkAnswer')->get();
    }

    public function showNames($id){
        $ref = postWork::findOrFail($id)->first()->id_form;
        return form::findOrFail($ref)->with('postWorkAnswer')->get();
    }

    
}
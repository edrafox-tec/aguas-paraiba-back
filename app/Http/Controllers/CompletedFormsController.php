<?php

namespace App\Http\Controllers;

use App\Models\form;
use Illuminate\Http\Request;

class CompletedFormsController extends Controller
{
    public function store($id, Request $request)
    {
        return form::findOrFail($id)->with('formThemes')->get();
    }
}
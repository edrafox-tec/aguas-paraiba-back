<?php

namespace App\Http\Controllers;

use App\Exports\PostWorkAnswerExport;
use App\Models\postWorkAnswer;
use App\Models\form;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Models\postWork;
use Illuminate\Support\Facades\Mail;
use App\Mail\mailsend;
use App\Models\assing;
use App\Models\User;
use Aws\Api\Parser\JsonParser;
use Excel;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Style\Supervisor;
use stdClass;

class PostWorkAnswerController extends Controller
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
    public function image64(Request $request)
    {
        $base64Img = $request->input('base64Img');
        if ($request->has('base64Img') && strpos($base64Img, ';base64')) {
            // aqui faz a montagem do base64 para imagem
            $extension = explode('/', $base64Img);
            $extension = explode(';', $extension[1]);
            $extension = '.' . $extension[0];
            $nameFile = time() . $extension;
            $onlyCodeBase64 = explode(',', $base64Img);
            $file = $onlyCodeBase64[1];
            $arquive = base64_decode($file);
            Storage::disk('s3')->put('aguasParaiba/' . $nameFile, $arquive, 'public');
            try {
                return response()->json(['https://edralivery-images.s3.amazonaws.com/aguasParaiba/' . $nameFile]);
            } catch (ClientException $e) {
                return $e->getMessage();
            }
        } else {
            return response()->json(['Tipo de arquivo não é base64']);
        }
    }

    public function create(Request $request)
    {
        $form = json_decode($request->input('form_array'));
        $tec = [];
        foreach ($form[0]->Themes as $theme) {
            foreach ($theme->AllAnswer as $Answers) {
                foreach ($Answers->answer as $answerType) {
                    if ($answerType->type_question == 'photo') {
                        $base64Img = $answerType->answer;
                        if (strpos($base64Img, ';base64')) {
                            // aqui faz a montagem do base64 para imagem
                            $extension = explode('/', $base64Img);
                            $extension = explode(';', $extension[1]);
                            $extension = '.' . $extension[0];
                            $nameFile = time() . rand(0, 999999) . $extension;
                            //$nameFile = time() . $extension;
                            $onlyCodeBase64 = explode(',', $base64Img);
                            $file = $onlyCodeBase64[1];
                            $arquive = base64_decode($file);
                            Storage::disk('s3')->put('aguasParaiba/' . $nameFile, $arquive, 'public');
                            try {
                                $answerType->answer = $nameFile;
                            } catch (ClientException $e) {
                                return $e->getMessage();
                            }
                        } else {
                            return response()->json(['Tipo de arquivo não é base64']);
                        }
                    }
                    if ($answerType->type_question === 'technician') {
                        $technician = $Answers->answer;
                        array_push($tec,$technician);
                    }
                }
            }
        }
        $postWorkAnswer = new postWorkAnswer;
        $postWorkAnswer->id_postWork = $request->input('id_postWork');
        $postWorkAnswer->form_array = json_encode($form, JSON_UNESCAPED_UNICODE);

        try {
            if ($postWorkAnswer->save()) {
                $id_postWork = $request->input('id_postWork');
                $pdf_url = url('/api/pdf/' . $id_postWork);
                if (count($tec) > 0) {
                    foreach($tec as $name){
                        $technician = User::where('name', $name[0]->answer)->first();
                        $bdTec = new assing;
                        $bdTec->user = $technician->name;
                        $bdTec->user_id = $technician->id;
                        $bdTec->level_user = $technician->id_sector;
                        $bdTec->postworkAnswer = $request->input('id_postWork');
                        $bdTec->save();
                        $user = new stdClass();
                        $user->name = $technician->name;
                        $user->email = $technician->email;
                        $user->pdf_url = $pdf_url;
                        Mail::to($technician->email)->send(new mailsend($user));
                    }
                };
                return $postWorkAnswer;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
    public function sing(Request $request)
    {
        $sing = user::where('name', $request->input('name'))->first();
        $form = postWorkAnswer::where('id', $request->input('id'))->first();
        if ($sing->id_sector == '14') {
            $form->sing_engen = $sing->signature;
        } else {
            $form->sing_prod = $sing->signature;
        }
        try {
            if ($form->save()) {
                $updateSing = assing::where('postworkAnswer',$form->id_postWork)->where('user_id',$sing->id)->first();
                $updateSing->signed = 1;
                if($updateSing->save()){
                    return response()->json(['Assinado com sucesso!']);
                }

            }
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
        $postWorkAnswer = postWorkAnswer::where('id', $id)->first();
        if (!$postWorkAnswer) {
            return 'Nenhum postWorkAnswer encontrado!';
        } else {
            return $postWorkAnswer;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $postWorkAnswer = postWorkAnswer::get();
        return $postWorkAnswer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(postWorkAnswer $postWorkAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $postWorkAnswer = postWorkAnswer::findOrFail($id);
        $postWorkAnswer->id_postWork = $request->input('id_postWork');
        $postWorkAnswer->form_array = $request->input('form_array');
        try {
            if ($postWorkAnswer->save()) {
                return $postWorkAnswer;
            };
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\postWorkAnswer  $postWorkAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletado = postWorkAnswer::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }

    public function export($id)
    {
        $formAnswer = postWorkAnswer::where('id_postWork', $id)->first();
        $PostWork = postWork::where('id', $formAnswer->id_postWork)->first();
        $Form = form::where('id', $PostWork->id_form)->first();
        $ExcelPlan = new PostWorkAnswerExport($id);
        return Excel::download($ExcelPlan, $Form->name . '.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\PostWorkAnswerExport;
use App\Models\postWorkAnswer;
use App\Models\form;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Models\postWork;
use Aws\Api\Parser\JsonParser;
use Excel;
//use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage;

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
        /*$s3Client = S3Client::factory(array(
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => array(
                'key'    => 'AKIAQDDSEW63243IY5BP',
                'secret' => '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',
            )
        ));*/
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
        $base64Images = $request->input('base64_images');
        $maxBatchSize = 10;
        $numBatches = ceil(count($base64Images) / $maxBatchSize);
        $batchIndex = 0;
    
        while ($batchIndex < $numBatches) {
            $batch = array_slice($base64Images, $batchIndex * $maxBatchSize, $maxBatchSize);
            $imagesProcessed = 0;
    
            foreach ($form[0]->Themes as $theme) {
                foreach ($theme->AllAnswer as $Answers) {
                    foreach ($Answers->answer as $answerType) {
                        if ($answerType->type_question == 'photo') {
                            $base64Img = $batch[$imagesProcessed];
                            if (strpos($base64Img, ';base64')) {
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
                                    $answerType->answer = $nameFile;
                                } catch (ClientException $e) {
                                    return $e->getMessage();
                                }
                            } else {
                                return response()->json(['Tipo de arquivo não é base64']);
                            }
                            $imagesProcessed++;
                        }
                    }
                }
            }
    
            $postWorkAnswer = new postWorkAnswer;
            $postWorkAnswer->id_postWork = $request->input('id_postWork');
            $postWorkAnswer->form_array = json_encode($form, JSON_UNESCAPED_UNICODE);
    
            try {
                if ($postWorkAnswer->save()) {
                    return $postWorkAnswer;
                };
            } catch (ClientException $e) {
                return $e->getMessage();
            }
    
            $batchIndex++;
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

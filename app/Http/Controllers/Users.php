<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\ClientException;

use Illuminate\Http\Request;
use Mockery\Undefined;

class Users extends Controller
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
        function firstname_lastname($fullname)
        {
            $names = explode(' ', $fullname);
            if (count($names) === 1) { // caso alguém tenha um só nome
                return $names[0];
            }
            return $names[0] . '.' . $names[count($names) - 1];
        }
        $fullname = $request->input('name');
        $firstname_lastname = firstname_lastname($fullname);

        $user = new User();
        $user->name = $request->input('name');
        $user->registration = $request->input('registration');
        $user->password = bcrypt($request->input('password'));
        $user->function = $request->input('function');
        $user->level = 0;
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->activated = 0;
        $user->nickname = $firstname_lastname;
        $user->signature = $request->input('signature');
        $user->id_sector = $request->input('id_sector');
        try {
            if ($user->save()) {
                return $user;
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
        $user = user::where('id', $id)->first();
        if (!$user) {
            return 'Nenhum user encontrado!';
        } else {
            return $user;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $names = user::get();
        return $names;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $fullname = $request->input('name');
        $firstname_lastname = firstname_lastname($fullname);


        $user = user::findOrFail($id);
        $user->name = $request->input('name');
        $user->registration = $request->input('registration');
        $user->password = bcrypt($request->input('password'));
        $user->function = $request->input('function');
        $user->level = $request->input('level');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->activated = $request->input('activated');
        $user->nickname = $firstname_lastname;
        $user->id_sector = $request->input('id_sector');
        try {
            if ($user->save()) {
                return $user;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
    public function changePass($id, Request $request)
    {
        $userPass = user::where('id', $id)->first();
        $credentials = (['nickname' => $userPass->nickname, 'password' => $request->input('current_pass')]);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Senha divergente'], 401);
        } else {
            $userPass->password = bcrypt($request->input('new_pass'));
            if($userPass->save()){
                return $userPass;
            }else{
                return 'não foi possivel alterar a senha!';
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function destroy($id)
    {
        $deletado = user::where('id', $id)->delete();
        if ($deletado) {
            return 'Deletado com sucesso!';
        } else {
            return 'Erro ao deletar!';
        }
    }
}

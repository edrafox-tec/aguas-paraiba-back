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
        $nickname = $firstname_lastname;

        // Verifica se o nickname já existe
        while (User::where('nickname', $nickname)->first()) {
            $nickname = $firstname_lastname . '_' . rand(1, 100);
        }

        // Verifica se o registration já existe
        if (User::where('registration', $request->input('registration'))->first()) {
            return 1062;
        }
        $function = '';
        if($request->input('type_function') == 1){
            $function = 'Supervisor';
        }
        if($request->input('type_function') == 2){
            $function = 'Técnico';
        }
        if($request->input('type_function') == 3){
            $function = 'Fiscal';
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->registration = $request->input('registration');
        $user->password = bcrypt($request->input('password'));
        $user->function = $function;
        $user->level = 0;
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->activated = 0;
        $user->nickname = $nickname;
        $user->signature = $request->input('signature');
        $user->id_sector = $request->input('id_sector');
        $user->type_function = $request->input('type_function');
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
        function firstname_lastnames($fullname)
        {
            $names = explode(' ', $fullname);
            if (count($names) === 1) { // caso alguém tenha um só nome
                return $names[0];
            }
            return $names[0] . '.' . $names[count($names) - 1];
        }

        $fullname = $request->input('name');
        $firstname_lastname = firstname_lastnames($fullname);
        $nickname = $firstname_lastname;

        // Verifica se o nickname já existe
        while (User::where('nickname', $nickname)->first()) {
            $nickname = $firstname_lastname . '_' . rand(1, 100);
        }


        $user = user::findOrFail($id);
        $function = '';
        if($request->input('type_function') == 1){
            $function = 'Supervisor';
        }
        if($request->input('type_function') == 2){
            $function = 'Técnico';
        }
        if($request->input('type_function') == 3){
            $function = 'Fiscal';
        }
        $user->name = $request->input('name');
        $user->registration = $request->input('registration');
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->function = $function;
        $user->level = $request->input('level');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->activated = $request->input('activated');
        $user->nickname = $firstname_lastname;
        $user->id_sector = $request->input('id_sector');
        $user->type_function = $request->input('type_function');
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
            if ($userPass->save()) {
                return $userPass;
            } else {
                return 'não foi possivel alterar a senha!';
            }
        }
    }
    public function changeSignature($id, Request $request)
    {
        $user = user::where('id', $id)->first();
        $user->signature = $request->input('signature');
        if ($user->save()) {
            return $user;
        } else {
            return ['Erro'];
        }
    }
    public function updateStatus($id, Request $request)
    {
        $user = user::where('id', $id)->first();
        $user->activated = $request->input('activated');
        try {
            if ($user->save()) {
                return $user;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }

    public function listUsersByTypeFunction(Request $request)
{
    $type_function = $request->input('type_function');
    $users = User::where('type_function', $type_function)->select('id', 'name')->get();

    if ($users->isEmpty()) {
        return response()->json(['message' => 'No users found with this type of function'], 404);
    }

    return response()->json($users, 200);
}


    public function updateTypeFunction($id, Request $request)
    {
        $user = user::where('id', $id)->first();
        $user->type_function = $request->input('type_function');
        try {
            if ($user->save()) {
                return $user;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
    /*********
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     *********/
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
        try {
            if ($deletado) {
                return 'Deletado com sucesso';
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
}

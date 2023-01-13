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
        function firstname_lastname($fullname) {
            $names = explode(' ', $fullname);
            if(count($names) === 1) { // caso alguém tenha um só nome
                return $names[0];
            }
            return $names[0]. '.' .$names[count($names) - 1];
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
            if($user->save()){
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
            if($user->save()){
                return $user;
            }
        } catch (ClientException $e) {
            return $e->getMessage();
        }
    }
    public function changePass($id,Request $request){
        $userPass = user::where('id',$id)->first();
        $currentPass = bcrypt($request->input('current_pass'));
        if($currentPass === $userPass->password ){
            $userPass->password = bcrypt($request($request->input('new_pass')));
            try{
                return $userPass;
            }catch(ClientException $e){
                return $e->getMessage();
            }
        }else{
            return 'Senha divergente!'
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
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

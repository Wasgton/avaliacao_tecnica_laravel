<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index',[
            'users'=>User::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required|max:255|string',
           'email'=>'required|unique:users|email|Max:255',
           'password'=>'required|confirmed|min:8|String',

        ],[
            'required'=>'O campo :attribute é obrigatorio',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if(!$user->save()){
            return redirect()->back();
        }

        return redirect()->route('admin.users.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user'=>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $this->validate($request,[
            'name'=>'required|max:255|string',
            'email'=>'required|email|Max:255|unique:users,email,'.$user->id,
            'password'=>'confirmed|min:8|String|nullable',

        ],[
            'required'=>'O campo :attribute é obrigatorio',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if(!is_null($request->password)){
            $user->password = Hash::make($request->password);
        }

        if(!$user->save()){
            return redirect()->back();
        }

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!$user->delete()){
            Session::flash('error','Erro ao deletar o estado');
        }

        return redirect()->back();
    }
}

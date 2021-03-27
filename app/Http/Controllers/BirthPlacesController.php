<?php

namespace App\Http\Controllers;

use App\BirthPlaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BirthPlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.birth_places.index',[
            'birth_places'=>BirthPlaces::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.birth_places.create');
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
            'place' => 'Required|string|min:2|max:2'
        ]);

        $birthPlace = new BirthPlaces();

        $birthPlace->place = $request->place;
        if(!$birthPlace->save()){
            return redirect()->back();
        }

        return redirect()->route('admin.birthPlaces.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BirthPlaces  $birthPlaces
     * @return \Illuminate\Http\Response
     */
    public function show(BirthPlaces $birthPlaces)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BirthPlaces  $birthPlaces
     * @return \Illuminate\Http\Response
     */
    public function edit(BirthPlaces $birthPlaces)
    {
        return view('admin.birth_places.edit',[
            'birthPlace'=>$birthPlaces
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BirthPlaces  $birthPlaces
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BirthPlaces $birthPlaces)
    {
        $this->validate($request,[
            'place' => 'Required|string|min:2|max:2'
        ]);

        $birthPlaces->place = $request->place;
        if(!$birthPlaces->save()){
            return redirect()->back();
        }

        return redirect()->route('admin.birthPlaces.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BirthPlaces  $birthPlaces
     * @return \Illuminate\Http\Response
     */
    public function destroy(BirthPlaces $birthPlaces)
    {
       if(!$birthPlaces->delete()){
           Session::flash('error','Erro ao deletar o estado');
       }

       return redirect()->back();
    }
}

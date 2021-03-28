<?php

namespace App\Http\Controllers;

use App\BirthPlaces;
use App\Client;
use App\ClientsPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clients.index',[
            'clients'=>Client::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.clients.create',[
           'birthPlaces'=>BirthPlaces::all()
       ]);
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
            'name'=>'required|string|max:255|',
            'cpf'=>'required|string|max:11|',
            'rg'=>'required|string|max:255|',
            'birth_date'=>'required|date',
            'birth_place'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $client = new Client();
            $client->name = $request->name;
            $client->rg = $request->rg;
            $client->cpf = $request->cpf;
            $client->birth_date = $request->birth_date;
            $client->birth_place_id = $request->birth_place;
            $client->created_for = Auth::user()->id;

            if($client->save()){
                foreach ($request->phone as $phone){
                    $clientPhone = new ClientsPhone();
                    $clientPhone->client_id = $client->id;
                    $clientPhone->phone = $phone;
                    $clientPhone->save();
                }
            }

            DB::commit();
            Session::flash('success','Cliente registrado com sucesso');
            return redirect()->route('admin.clients.index');

        }catch (\Exception $exception){

            DB::rollBack();
            Session::flash('error','Erro ao registrar o cliente: '.$exception->getMessage());
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {

        return view('admin.clients.edit',[
            'client'=>$client,
            'birthPlaces'=>BirthPlaces::all(),
            'phones'=>ClientsPhone::where('client_id',$client->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255|',
            'cpf'=>'required|string|max:11|',
            'rg'=>'required|string|max:255|',
            'birth_date'=>'required|date',
            'birth_place'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $client = new Client();
            $client->name = $request->name;
            $client->rg = $request->rg;
            $client->cpf = $request->cpf;
            $client->birth_date = $request->birth_date;
            $client->birth_place_id = $request->birth_place;
            $client->updated_for = Auth::user()->id;

            if($client->save()){
                foreach ($request->phone as $phone){
                    $clientPhone = new ClientsPhone();
                    $clientPhone->client_id = $client->id;
                    $clientPhone->phone = $phone;
                    $clientPhone->save();
                }
            }

            DB::commit();
            Session::flash('success','Cliente registrado com sucesso');
            return redirect()->route('admin.clients.index');

        }catch (\Exception $exception){

            DB::rollBack();
            Session::flash('error','Erro ao registrar o cliente: '.$exception->getMessage());
            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}

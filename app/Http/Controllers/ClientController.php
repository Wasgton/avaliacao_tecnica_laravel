<?php

namespace App\Http\Controllers;

use App\BirthPlaces;
use App\Client;
use App\ClientsPhone;
use App\User;
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

        $chars = [',','/','(',')',' ','-','.'];

        $this->validate($request,[
            'name'=>'required|string|max:255|',
            'cpf'=>'required|string|max:14',
            'rg'=>'required|string',
            'birth_date'=>'required|date',
            'birth_place'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $client = new Client();
            $client->name = $request->name;
            $client->rg = str_replace($chars,'',$request->rg);
            $client->cpf = str_replace($chars,'',$request->cpf);
            $client->birth_date = $request->birth_date;
            $client->birth_place_id = $request->birth_place;
            $client->created_for = Auth::user()->id;

            if($client->save()){
                foreach ($request->phone as $phone){
                    $clientPhone = new ClientsPhone();
                    $clientPhone->client_id = $client->id;
                    $clientPhone->phone = str_replace($chars,'',$phone);
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

        $details['updated_for'] = $client->updatedFor();
        $details['created_for'] = $client->createFor();

        $details['created_for'] = $details['created_for']->name;
        $details['updated_for'] = $details['updated_for']->name;

        return view('admin.clients.edit',[
            'client'=>$client,
            'details'=>$details,
            'birthPlaces'=>BirthPlaces::all(),
            'phones'=> $client->phonesByClient()
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
        $chars = [',','/','(',')',' ','-','.'];

        $this->validate($request,[
            'name'=>'required|string|max:255|',
            'cpf'=>'required|string|max:14|',
            'rg'=>'required|string|max:255|',
            'birth_date'=>'required|date',
            'birth_place'=>'required',
        ]);

        try{

            DB::beginTransaction();

            $client->name = $request->name;
            $client->rg = $request->rg;
            $client->cpf = $request->cpf;
            $client->birth_date = $request->birth_date;
            $client->birth_place_id = $request->birth_place;
            $client->updated_for = Auth::user()->id;
            $client->save();

            foreach ($request->phone as $key => $phone){

                $clientPhone = ClientsPhone::find($key);

                if($clientPhone){
                    $clientPhone->phone = $phone;
                    $clientPhone->save();
                }else{
                    $clientPhone = new ClientsPhone();
                    $clientPhone->client_id = $client->id;
                    $clientPhone->phone = str_replace($chars,'',$phone);
                    $clientPhone->save();
                }

            }

            DB::commit();
            Session::flash('success','Cliente atualizado com sucesso');
            return redirect()->route('admin.client.index');

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
        if(!$client->delete()){
            Session::flash('error','Erro ao deletar o cliente');
        }

        return redirect()->back();
    }
}

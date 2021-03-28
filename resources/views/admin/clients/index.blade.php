@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{route('admin.clients.create')}}">Novo</a>
                <div class="card">
                    <div class="card-header">Clientes</div>
                    <div class="card-body">
                        @if(count($errors)>0)
                                @foreach($errors->all() as $error)
                                    <script>alert('{{$error}}');</script>
                                @endforeach
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>
                                        {{$client->id}}
                                    </td>
                                    <td>
                                        {{$client->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.clients.edit',['cliente'=>$client->id])}}">Editar</a>
                                        <form action="{{route('admin.clients.destroy',['cliente'=>$client->id])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type='submit' value="X">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$clients->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

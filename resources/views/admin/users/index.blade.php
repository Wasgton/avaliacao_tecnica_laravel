@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{route('admin.users.create')}}">Novo</a>
                <div class="card">
                    <div class="card-header">Estados</div>
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
                                    <th>Estado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->id}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.users.edit',['usuario'=>$user->id])}}">Editar</a>
                                        <form action="{{route('admin.users.destroy',['usuario'=>$user->id])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type='submit' value="X">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

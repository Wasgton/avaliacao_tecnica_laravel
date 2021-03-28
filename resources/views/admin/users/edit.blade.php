@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuário</div>
                    <div class="card-body">
                        <form action="{{route('admin.users.update',['usuario'=>$user->id])}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group col-md-4">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password_confirmation">Confirmação de senha</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                            </div>
                            <button class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                    @if(count($errors)>0)
                        <div class="container">
                            <ul class="list-group">
                                <h4>Errors no formulario</h4>
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

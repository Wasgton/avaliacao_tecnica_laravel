@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cliente</div>
                    <div class="card-body">
                        <form action="{{route('admin.clients.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cpf">CPF</label>
                                        <input type="text" name="cpf" id="cpf" class="form-control" value="{{old('cpf')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rg">RG</label>
                                        <input type="text" name="rg" id="rg" class="form-control" value="{{old('rg')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="birth_date">Data de nascimento</label>
                                        <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{old('birth_date')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Local de Nascimento</label>
                                        <select name="birth_place" class="form-control">
                                            @foreach($birthPlaces as $birthPlace)
                                                <option value="{{$birthPlace->id}}">{{$birthPlace->place}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Telefones
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Telefone</label>
                                            <input type="text" name="phone[1]" id="phone[1]" class="form-control">
                                        </div>
                                        <a href="javascript:" class="btn btn-primary" onclick="addPhoneLine(this)">+</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <button class="btn btn-primary">Salvar</button>
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

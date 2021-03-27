@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Estados</div>
                    <div class="card-body">
                        <form action="{{route('admin.birthPlaces.store')}}" method="post">
                            @csrf
                            <div class="form-group col-md-4">
                                <label for="">Estado</label>
                                <input type="text" name="place" class="form-control" value="{{old('place')}}">
                            </div>
                            <button class="btn btn-primary" href="{{route('admin.birthPlaces.create')}}">Salvar</button>
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

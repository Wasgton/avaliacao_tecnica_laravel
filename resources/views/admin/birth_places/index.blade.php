@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{route('admin.birthPlaces.create')}}">Novo</a>
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
                                @foreach($birth_places as $birth_place)
                                <tr>
                                    <td>
                                        {{$birth_place->id}}
                                    </td>
                                    <td>
                                        {{$birth_place->place}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.birthPlaces.edit',['birthPlace'=>$birth_place->id])}}">Editar</a>
                                        <form action="{{route('admin.birthPlaces.destroy',['birthPlaces'=>$birth_place->id])}}" method="post">
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

@extends('adminlte::page')

@section('title', 'Detalhes do profile')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" class="active">Voltar</a></li>
    </ol>
    <h1>Detalhes do profile <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-minus-square"></i> DELETAR O PERFIL {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@endsection
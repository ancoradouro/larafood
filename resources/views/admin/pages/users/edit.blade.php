@extends('adminlte::page')

@section('title', "Editar o usuário - {$user->name}")

@section('content_header')
    <h1>Editar o Usuário - {{ $user->name }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.users._partials.form')
                
            </form>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-minus-square"></i> Deletar o usuário {{ $user->name }}</button>
            </form>
        </div>
    </div>
@endsection

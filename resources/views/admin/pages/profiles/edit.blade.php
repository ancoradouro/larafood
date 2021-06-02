@extends('adminlte::page')

@section('title', "Editar o perfil - {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}" class="active">Voltar</a></li>
    </ol>
    <h1>Detalhes do profileo <b>{{ $profile->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profiles.update', $profile->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@endsection
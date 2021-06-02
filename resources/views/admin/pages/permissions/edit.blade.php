@extends('adminlte::page')

@section('title', "Editar a permissão - {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" class="active">Voltar</a></li>
    </ol>
    <h1>Detalhes da permissão <b>{{ $permission->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@endsection

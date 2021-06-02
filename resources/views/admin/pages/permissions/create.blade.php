@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" class="active">Voltar</a></li>
    </ol>
    <h1>Cadastrar Nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" class="form" method="POST">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@endsection

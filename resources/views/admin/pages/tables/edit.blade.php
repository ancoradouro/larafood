@extends('adminlte::page')

@section('title', "Editar a mesa - {$table->name}")

@section('content_header')
    <h1>Editar a Mesa - {{ $table->name }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.tables._partials.form')
                
            </form>
            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-minus-square"></i> Deletar a Mesa {{ $table->name }}</button>
            </form>
        </div>
    </div>
@endsection

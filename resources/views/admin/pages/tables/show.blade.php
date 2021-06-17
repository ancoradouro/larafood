@extends('adminlte::page')

@section('title', 'Detalhes da Mesas')

@section('content_header')
    <h1>Detalhes da Mesas <b>{{ $table->identify }}</b></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Identificação: </strong> {{ $table->identify }}
                </li>
                </li>
                    <strong>Descrição: </strong> {{ $table->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Detelar a Mesa {{ $table->identify }}</button>
            </form>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Detalhes da Categoria')

@section('content_header')
    <h1>Detalhes da Categoria <b>{{ $category->name }}</b></h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>Url: </strong> {{ $category->url }}
                </li>
                    <strong>Descição: </strong> {{ $category->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Detelar o Categoria {{ $category->name }}</button>
            </form>
        </div>
    </div>
@endsection

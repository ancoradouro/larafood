@extends('adminlte::page')

@section('title', "Editar o usuário - {$category->name}")

@section('content_header')
    <h1>Editar o Categoria - {{ $category->name }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.categories._partials.form')
                
            </form>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-minus-square"></i> Deletar a Categoria {{ $category->name }}</button>
            </form>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', "Editar o produto - {$product->title}")

@section('content_header')
    <h1>Editar o Produto - {{ $product->description }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.products._partials.form')
                
            </form>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-minus-square"></i> Deletar o Produto {{ $product->title }}</button>
            </form>
        </div>
    </div>
@endsection

@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a> </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <form action="{{ route('products.search') }}" method="post" class="form form-inline">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}" aria-label="Nome" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-dark btn-outline-secondary" type="sumit" > <i class="fas fa-filter"></i> Filtrar</button>
                    </div>
                </div> 
            </form>
        </div>
        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th style="width:350px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img class="" src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" /></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td style="width:250px;">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary"> <i class="fas fa-info-circle"></i> Detalhes</a> 
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"> <i class="fas fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop

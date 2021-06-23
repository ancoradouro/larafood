@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}" class="active">Produtos</a></li>
    </ol>
    <h1>Empresas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('tenants.search') }}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark"> <i class="fas fa-filter"></i> Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th style="max-width: 90px;" >Imagem</th>
                    <th>Nome</th>
                    <th style="width:300px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                    <tr>
                        {{-- <td>{{ $tenant->image }}</td> --}}
                        <td>
                            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width: 90px;">
                        </td>
                        <td>{{ $tenant->name }}</td>
                        <td style="width:300px;">
                            {{-- <a href="{{ route('tenants.categories', $tenant->id) }}" class="btn btn-warning" title="Categorias"><i class="fas fa-layer-group"></i></a> --}}
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info"> Editar</a>
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning"> <i class="fas fa-eye"></i> Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
            {{-- {!! $tenants->links() !!} --}}
            {!! $tenants->appends($filters)->links() !!}
        @else
            {!! $tenants->links() !!}
        @endif
    </div>
</div>
@stop

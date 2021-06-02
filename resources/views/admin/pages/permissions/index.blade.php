@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}" class="active">Permissões</a></li>
    </ol>
    <h1>Permissões <a href="{{ route('permissions.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a> </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('permissions.search') }}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
            <button type="submit" class="btn btn-dark"> <i class="fas fa-filter"></i> Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th style="width:250px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td style="width:250px;">
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Editar</a>
                            <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning"> <i class="fas fa-eye"></i> Ver</a>
                            <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
            {{-- {!! $permissions->links() !!} --}}
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif
    </div>
</div>
@stop
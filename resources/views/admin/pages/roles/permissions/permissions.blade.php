@extends('adminlte::page')

@section('title', 'Permissões do Cargo {$role->name}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}" class="active">Cargos</a></li>
    </ol>
    <h1>Permissões do Cargo <strong> {{ $role->name }} </strong></h1>
    <a href="{{ route('roles.permissions.available', $role->id ) }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD NOVA PERMISSÂO</a>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th style="width:50px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td style="width:250px;">
                            <a href="{{ route('roles.permission.detach', [$role->id, $permission->id]) }}" class="btn btn-danger">Desvincular</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
            {{-- {!! $roles->links() !!} --}}
            {!! $permissions->appends($filters)->links() !!}
        @else
            {!! $permissions->links() !!}
        @endif
    </div>
</div>
@stop

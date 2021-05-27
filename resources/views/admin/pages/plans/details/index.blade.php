@extends('adminlte::page')

@section('title', "Detalhes do Planos {$plan->name}")

@section('content_header')
    <h1>Detalhes do Planos <a href="{{ route('plans.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a> </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index', $plan->url) }}" class="active">Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width:180px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td style="width:300px;">
                                <a href="{{ route('plans.edit', $detail->name) }}" class="btn btn-info"> <i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('plans.show', $detail->name) }}" class="btn btn-warning"> <i class="fas fa-eye"></i> Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif
        </div>
    </div>
@stop

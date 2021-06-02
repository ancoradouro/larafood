@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <h1>Planos <a href="{{ route('plans.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a> </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" class="active">Planos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <form action="{{ route('plans.search') }}" method="post" class="form form-inline">
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
                        <th>Nome</th>
                        <th>Preço</th>
                        <th style="width:180px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td style="width:300px;">
                                <a href="{{ route('details.plan.index', $plan->id) }}" class="btn btn-primary"> <i class="fas fa-info-circle"></i> Detalhes</a>
                                <a href="{{ route('plans.edit', $plan->url) }}" class="btn btn-info"> <i class="fas fa-edit"></i> Editar</a>
                                <a href="{{ route('plans.show', $plan->url) }}" class="btn btn-warning"> <i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif
        </div>
    </div>
@stop

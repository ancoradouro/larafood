@extends('adminlte::page')

@section('title', "Perfil do Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->id) }}" class="active">Perfis</a></li>
    </ol>
    <h1>Perfil do Plano <strong> {{ $plan->name }} </strong></h1>
    <a href="{{ route('plans.profiles.available', $plan->id ) }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> Adicionar novo Perfil</a>
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
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->name }}</td>
                        <td style="width:250px;">
                            <a href="{{ route('plans.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-danger"> <i class="fas fa-unlink"></i> Desvincular</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
            {{-- {!! $plans->links() !!} --}}
            {!! $profiles->appends($filters)->links() !!}
        @else
            {!! $profiles->links() !!}
        @endif
    </div>
</div>
@stop

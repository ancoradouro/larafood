@extends('adminlte::page')

@section('title', "Editar o plano - {$plan->name}")

@section('content_header')
    <h1>Editar o plano - {{ $plan->name }}</h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}" class="active">Voltar</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@endsection

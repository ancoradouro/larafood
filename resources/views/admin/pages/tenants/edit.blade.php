@extends('adminlte::page')

@section('title', "Editar a Empresa - {$tenant->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}" class="active">Voltar</a></li>
    </ol>
    <h1>Detalhes da Empresa<b>{{ $tenant->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
@endsection

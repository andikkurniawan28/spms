@extends('template.master')

@section('gateways-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'create_gateway')) }}</strong></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('gateways.store') }}" method="POST">
                @csrf

                {{-- name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ ucwords(str_replace('_', ' ', 'name')) }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name') }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ ucwords(str_replace('_', ' ', 'save')) }}
                </button>
                <a href="{{ route('gateways.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ ucwords(str_replace('_', ' ', 'cancel')) }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection

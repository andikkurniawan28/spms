@extends('template.master')

@section('complexities-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'edit_complexity')) }}</strong></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('complexities.update', $complexity->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $complexity->title) }}" required>
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $complexity->description) }}</textarea>
                </div>

                {{-- default price --}}
                <div class="mb-3">
                    <label for="default_price" class="form-label">Default Price</label>
                    <input type="number" step="0.01" name="default_price" id="default_price" class="form-control"
                        value="{{ old('default_price', $complexity->default_price) }}" required>
                </div>

                {{-- default duration --}}
                <div class="mb-3">
                    <label for="default_duration" class="form-label">Default Duration (hours)</label>
                    <input type="number" step="0.1" name="default_duration" id="default_duration" class="form-control"
                        value="{{ old('default_duration', $complexity->default_duration) }}" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Update
                </button>
                <a href="{{ route('complexities.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection

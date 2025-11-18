@extends('template.master')

@section('users-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
    <div class="container-fluid py-0 px-0">
        <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'create_user')) }}</strong></h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    {{-- role --}}
                    <div class="mb-3">
                        <label for="role_id" class="form-label">{{ ucwords(str_replace('_', ' ', 'role')) }}</label>
                        <select name="role_id" id="role_id" class="form-select select2" required>
                            <option value="">-- Select {{ ucwords(str_replace('_', ' ', 'role')) }} --</option>
                            @foreach ($roles as $id => $name)
                                <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ ucwords(str_replace('_', ' ', 'name')) }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required autofocus>
                    </div>

                    {{-- username --}}
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ ucwords(str_replace('_', ' ', 'username')) }}</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username') }}" required>
                    </div>

                    {{-- password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ ucwords(str_replace('_', ' ', 'password')) }}</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    {{-- confirm password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm {{ ucwords(str_replace('_', ' ', 'password')) }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            required>
                    </div>

                    {{-- status --}}
                    <div class="mb-3">
                        <label for="is_active" class="form-label">{{ ucwords(str_replace('_', ' ', 'status')) }}</label>
                        <select name="is_active" id="is_active" class="form-select select2">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', 'active')) }}</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', 'non-active')) }}</option>
                        </select>
                    </div>

                    {{-- Telpon --}}
                    {{-- <div class="mb-3">
                        <label for="phone" class="form-label">Telpon</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone') }}" required>
                    </div> --}}

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> {{ ucwords(str_replace('_', ' ', 'save')) }}
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> {{ ucwords(str_replace('_', ' ', 'cancel')) }}
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('template.master')

@section('clients-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'create_client')) }}</strong></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                {{-- prefix --}}
                <div class="mb-3">
                    <label for="prefix" class="form-label">{{ ucwords(str_replace('_', ' ', 'prefix')) }}</label>
                    <input type="text" name="prefix" id="prefix" class="form-control"
                        value="{{ old('prefix') }}" required>
                </div>

                {{-- fullname --}}
                <div class="mb-3">
                    <label for="fullname" class="form-label">{{ ucwords(str_replace('_', ' ', 'fullname')) }}</label>
                    <input type="text" name="fullname" id="fullname" class="form-control"
                        value="{{ old('fullname') }}" required>
                </div>

                {{-- nickname --}}
                <div class="mb-3">
                    <label for="nickname" class="form-label">{{ ucwords(str_replace('_', ' ', 'nickname')) }}</label>
                    <input type="text" name="nickname" id="nickname" class="form-control"
                        value="{{ old('nickname') }}" required>
                </div>

                {{-- phone --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ ucwords(str_replace('_', ' ', 'phone')) }}</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone') }}" required>
                </div>

                {{-- email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ ucwords(str_replace('_', ' ', 'email')) }}</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email') }}">
                </div>

                {{-- organization --}}
                <div class="mb-3">
                    <label for="organization" class="form-label">{{ ucwords(str_replace('_', ' ', 'organization')) }}</label>
                    <input type="text" name="organization" id="organization" class="form-control"
                        value="{{ old('organization') }}" required>
                </div>

                {{-- role --}}
                <div class="mb-3">
                    <label for="role" class="form-label">{{ ucwords(str_replace('_', ' ', 'role')) }}</label>
                    <input type="text" name="role" id="role" class="form-control"
                        value="{{ old('role') }}" required>
                </div>

                {{-- birthday --}}
                <div class="mb-3">
                    <label for="birthday" class="form-label">{{ ucwords(str_replace('_', ' ', 'birthday')) }}</label>
                    <input type="date" name="birthday" id="birthday" class="form-control"
                        value="{{ old('birthday') }}">
                </div>

                {{-- id number --}}
                <div class="mb-3">
                    <label for="id_number" class="form-label">{{ ucwords(str_replace('_', ' ', 'id_number')) }}</label>
                    <input type="text" name="id_number" id="id_number" class="form-control"
                        value="{{ old('id_number') }}">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ ucwords(str_replace('_', ' ', 'save')) }}
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> {{ ucwords(str_replace('_', ' ', 'cancel')) }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection

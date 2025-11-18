@extends('template.master')

@section('users-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'list_of_user')) }}</strong></h1>

    @if(Auth()->user()->role->create_user)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> {{ ucwords(str_replace('_', ' ', 'create_new')) }}
        </a>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-hover table-striped w-100 text-center">
                    <thead>
                        <tr>
                            <th>{{ strtoupper(str_replace('_', ' ', 'id')) }}</th>
                            <th>{{ ucwords(str_replace('_', ' ', 'name')) }}</th>
                            <th>{{ ucwords(str_replace('_', ' ', 'role')) }}</th>
                            <th>{{ ucwords(str_replace('_', ' ', 'status')) }}</th>
                            <th>{{ ucwords(str_replace('_', ' ', 'action')) }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            order: [[0, 'asc']],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'role', name: 'role.name' },
                { data: 'status', name: 'is_active', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection

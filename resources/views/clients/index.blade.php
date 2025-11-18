@extends('template.master')

@section('clients-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'list_of_client')) }}</strong></h1>

    @if(Auth()->user()->role->create_client)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> {{ ucwords(str_replace('_', ' ', 'create_new')) }}
        </a>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="clientTable" class="table table-bordered table-hover table-striped w-100 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prefix</th>
                            <th>Fullname</th>
                            <th>Nickname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Organization</th>
                            <th>Role</th>
                            <th>Birthday</th>
                            <th>ID Number</th>
                            <th>Action</th>
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
        $('#clientTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clients.index') }}",
            order: [[0, 'asc']],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'prefix', name: 'prefix' },
                { data: 'fullname', name: 'fullname' },
                { data: 'nickname', name: 'nickname' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'organization', name: 'organization' },
                { data: 'role', name: 'role' }, // jika relasi: role.name
                { data: 'birthday', name: 'birthday' },
                { data: 'id_number', name: 'id_number' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection

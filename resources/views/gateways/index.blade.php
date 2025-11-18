@extends('template.master')

@section('gateways-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'list_of_gateway')) }}</strong></h1>

    @if(Auth()->user()->role->create_gateway)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('gateways.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> {{ ucwords(str_replace('_', ' ', 'create_new')) }}
        </a>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="gatewayTable" class="table table-bordered table-hover table-striped w-100 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
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
        $('#gatewayTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('gateways.index') }}",
            order: [[0, 'asc']],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection

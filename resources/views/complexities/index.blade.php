@extends('template.master')

@section('complexities-active', 'active')
@section('master-show', 'show')
@section('master-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'list_of_complexity')) }}</strong></h1>

    @if(Auth()->user()->role->create_complexity)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('complexities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> {{ ucwords(str_replace('_', ' ', 'create_new')) }}
        </a>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="complexityTable" class="table table-bordered table-hover table-striped w-100 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Duration</th>
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
    $('#complexityTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('complexities.index') }}",
        order: [[0, 'asc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'default_price', name: 'default_price' },
            { data: 'default_duration', name: 'default_duration' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endsection

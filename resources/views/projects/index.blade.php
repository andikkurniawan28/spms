@extends('template.master')

@section('projects-active', 'active')
@section('transaction-show', 'show')
@section('transaction-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'list_of_project')) }}</strong></h1>

    @if(Auth()->user()->role->create_project)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> {{ ucwords(str_replace('_', ' ', 'create_new')) }}
        </a>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="projectTable" class="table table-bordered table-hover table-striped w-100 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Progress</th>
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
        $('#projectTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('projects.index') }}",
            order: [[0, 'asc']],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'client', name: 'client' },
                { data: 'title', name: 'title' },
                { data: 'status', name: 'status' },
                { data: 'progress', name: 'progress' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection

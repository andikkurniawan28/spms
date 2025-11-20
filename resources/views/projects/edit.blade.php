@extends('template.master')

@section('projects-active', 'active')
@section('transaction-show', 'show')
@section('transaction-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3">
        <strong>{{ ucwords(str_replace('_', ' ', 'edit_project')) }}</strong>
    </h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Client</label>
                        <select name="client_id" id="client_id" class="form-select select2" required>
                            <option value="">-- Select Client --</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ $client->id == $project->client_id ? 'selected' : '' }}>
                                    {{ $client->fullname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ $project->title }}" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Repo URL</label>
                        <input type="text" name="repo_url" class="form-control"
                            value="{{ $project->repo_url }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Demo URL</label>
                        <input type="text" name="demo_url" class="form-control"
                            value="{{ $project->demo_url }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Production URL</label>
                        <input type="text" name="production_url" class="form-control"
                            value="{{ $project->production_url }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Deadline</label>
                        <input type="date" name="deadline" class="form-control"
                            value="{{ $project->deadline }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Total</label>
                        <input type="number" step="0.01" name="total" class="form-control"
                            value="{{ $project->total }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Duration (months)</label>
                        <input type="number" step="0.1" name="duration" class="form-control"
                            value="{{ $project->duration }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Start</label>
                        <input type="date" name="start" class="form-control"
                            value="{{ $project->start }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Finish</label>
                        <input type="date" name="finish" class="form-control"
                            value="{{ $project->finish }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Progress (%)</label>
                        <input type="number" name="progress" class="form-control"
                            value="{{ $project->progress }}" min="0" max="100">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach (['proposal','negotiation','deal','development','release'] as $status)
                                <option value="{{ $status }}"
                                    {{ $project->status == $status ? 'selected' : '' }}>
                                    {{ ucwords($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Update
                        </button>

                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@extends('template.master')

@section('projects-active', 'active')
@section('transaction-show', 'show')
@section('transaction-active', 'active')

@section('content')
<div class="container-fluid py-0 px-0">
    <h1 class="h3 mb-3"><strong>{{ ucwords(str_replace('_', ' ', 'create_project')) }}</strong></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Client</label>
                    <select name="client_id" id="client_id" class="form-select select2" required>
                        <option value="">-- Select Client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->fullname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Repo URL</label>
                    <input type="text" name="repo_url" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Demo URL</label>
                    <input type="text" name="demo_url" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Production URL</label>
                    <input type="text" name="production_url" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Total</label>
                    <input type="number" step="0.01" name="total" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Duration (months)</label>
                    <input type="number" step="0.1" name="duration" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Start</label>
                    <input type="date" name="start" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Finish</label>
                    <input type="date" name="finish" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Progress (%)</label>
                    <input type="number" name="progress" class="form-control" value="0" min="0" max="100">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="proposal">Proposal</option>
                        <option value="negotiation">Negotiation</option>
                        <option value="deal">Deal</option>
                        <option value="development">Development</option>
                        <option value="release">Release</option>
                    </select>
                </div>

                <div class="col-md-4 mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> {{ ucwords(str_replace('_', ' ', 'save')) }}
                    </button>

                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> {{ ucwords(str_replace('_', ' ', 'cancel')) }}
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

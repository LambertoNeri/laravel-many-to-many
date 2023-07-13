@extends('Admin.layouts.base')

@section('contents')

@if (session('delete_success'))
@php
    $project = session('delete_success')
@endphp
<div class="alert alert-danger">
    "{{ $project->title }}" has been moved to the trash!!
    <form action="{{ route("admin.project.cancel", ['project' => $project] )}}" method="post">
        @csrf
        <button class="btn btn-warning">Cancel</button>
    </form>
</div>
@endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Last Update</th>
                <th scope="col">Collaborators</th>
                <th scope="col">Description</th>
                {{-- <th scope="col">Image</th> --}}
                <th scope="col">Technologies</th>
                <th scope="col">Link Github</th>
                <th scope="col">Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->title }}</th>
                    <td>{{ $project->author }}</td>
                    <td>{{ $project->creation_date }}</td>
                    <td>{{ $project->last_update }}</td>
                    <td>{{ $project->collaborators }}</td>
                    <td>{{ $project->description }}</td>
                    {{-- <td><img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"></td> --}}
                    <td>{{ implode(', ', $project->technologies->pluck('name')->all()) }}</td>
                    <td><a href="{{ $project->link_github }}">GitHub</a></td>
                    <td><a href="{{ route('admin.type.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a></td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.project.show', ['project' => $project]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.project.edit', ['project' => $project]) }}">Edit</a>
                        <form class="d-inline-block" method="POST" action="{{ route('admin.project.destroy', ['project' => $project]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form
                        action="{{ route('admin.project.destroy', ['project' => $project]) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                        data-template="{{ route('admin.project.destroy', ['project' => '*****']) }}"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

{{ $projects->links() }}
@endsection
@extends('Admin.layouts.base')

@section('contents')
<h1>Add Technology</h1>

    <form method="POST" action="{{ route('admin.technology.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name')}}">

            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div>
        </div>


        <button class="btn btn-primary">Crea</button>
    </form>
@endsection
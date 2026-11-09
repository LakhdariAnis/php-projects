@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Student Details</h2>
                <a class="btn btn-outline-secondary" href="{{ route('students.index') }}">Back</a>
            </div>

            <div class="card p-4">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $student->name }}</dd>

                    <dt class="col-sm-3">Age</dt>
                    <dd class="col-sm-9">{{ $student->age }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ $student->email }}</dd>

                    <dt class="col-sm-3">Added</dt>
                    <dd class="col-sm-9">{{ $student->created_at->format('d/m/Y H:i') }}</dd>
                </dl>

                <div class="mt-3">
                    <a class="btn btn-primary" href="{{ route('students.edit', $student->id) }}">Edit</a>
                </div>
            </div>
        </div>
    </div>
@endsection

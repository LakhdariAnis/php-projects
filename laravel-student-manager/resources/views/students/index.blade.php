@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Students List</h2>
        <a class="btn btn-primary" href="{{ route('students.create') }}">Add New Student</a>
    </div>

    <form method="GET" action="{{ route('students.index') }}" class="d-flex gap-2 mb-3">
        <input type="search" name="search" value="{{ $search }}" class="form-control"
            placeholder="Search by name or email">
        <button type="submit" class="btn btn-outline-primary">Search</button>
        @if ($search)
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Clear</a>
        @endif
    </form>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->age }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                    <a class="btn btn-sm btn-outline-secondary"
                                        href="{{ route('students.show', $student->id) }}">View</a>
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('students.edit', $student->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($students->isEmpty())
                <p class="text-center text-muted mt-3">No students found.</p>
            @endif
            {{ $students->links() }}
        </div>
    </div>
@endsection
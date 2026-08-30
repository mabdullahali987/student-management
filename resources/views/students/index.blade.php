@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div>
        <p class="eyebrow">Student directory</p>
        <h1>Students</h1>
        <p class="muted">Manage student records stored in Supabase PostgreSQL.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
</div>

<form method="GET" action="{{ route('students.index') }}" class="search-card">
    <label for="search">Search by name, email, or course</label>
    <div class="search-row">
        <input id="search" name="search" type="search" value="{{ $search }}" placeholder="e.g. Ali, ali@example.com, Flutter">
        <button class="btn btn-secondary" type="submit">Search</button>
        @if($search !== '')
            <a class="btn btn-ghost" href="{{ route('students.index') }}">Clear</a>
        @endif
    </div>
</form>

<div class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th class="actions-col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td class="strong">{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone ?: '—' }}</td>
                    <td><span class="pill">{{ $student->course }}</span></td>
                    <td>
                        <div class="actions">
                            <a class="link-btn" href="{{ route('students.show', $student) }}">View</a>
                            <a class="link-btn" href="{{ route('students.edit', $student) }}">Edit</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('Delete this student? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-btn danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <strong>No students found.</strong>
                        <span>{{ $search !== '' ? 'Try a different search term.' : 'Add your first student to get started.' }}</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($students->hasPages())
        <div class="pagination-wrap">
            {{ $students->links() }}
        </div>
    @endif
</div>
@endsection

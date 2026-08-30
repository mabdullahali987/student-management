@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="page-heading compact">
        <div>
            <p class="eyebrow">Student #{{ $student->id }}</p>
            <h1>{{ $student->name }}</h1>
            <p class="muted">Student details</p>
        </div>
        <div class="actions">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary">Edit</a>
            <a href="{{ route('students.index') }}" class="btn btn-ghost">Back</a>
        </div>
    </div>

    <div class="details-card">
        <dl class="details-grid">
            <div>
                <dt>Name</dt>
                <dd>{{ $student->name }}</dd>
            </div>
            <div>
                <dt>Email</dt>
                <dd>{{ $student->email }}</dd>
            </div>
            <div>
                <dt>Phone</dt>
                <dd>{{ $student->phone ?: 'Not provided' }}</dd>
            </div>
            <div>
                <dt>Course</dt>
                <dd>{{ $student->course }}</dd>
            </div>
            <div>
                <dt>Created</dt>
                <dd>{{ $student->created_at?->format('M d, Y H:i') }}</dd>
            </div>
            <div>
                <dt>Updated</dt>
                <dd>{{ $student->updated_at?->format('M d, Y H:i') }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection

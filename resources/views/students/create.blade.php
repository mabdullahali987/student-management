@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="page-heading compact">
        <div>
            <p class="eyebrow">Create</p>
            <h1>Add Student</h1>
            <p class="muted">Enter the student's basic information.</p>
        </div>
        <a href="{{ route('students.index') }}" class="btn btn-ghost">Back to Students</a>
    </div>

    <div class="form-card">
        @include('students.partials.form', [
            'action' => route('students.store'),
            'method' => 'POST',
            'submitLabel' => 'Create Student',
        ])
    </div>
</div>
@endsection

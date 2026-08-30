@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="page-heading compact">
        <div>
            <p class="eyebrow">Update</p>
            <h1>Edit Student</h1>
            <p class="muted">Update the student's information and save your changes.</p>
        </div>
        <a href="{{ route('students.show', $student) }}" class="btn btn-ghost">View Student</a>
    </div>

    <div class="form-card">
        @include('students.partials.form', [
            'action' => route('students.update', $student),
            'method' => 'PUT',
            'submitLabel' => 'Save Changes',
            'student' => $student,
        ])
    </div>
</div>
@endsection

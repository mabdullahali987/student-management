<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Student Management' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('students.index') }}" class="brand">Student Management</a>
            <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
        </div>
    </header>

    <main class="container main-content">
        @if(session('success'))
            <div class="alert alert-success" role="status">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>

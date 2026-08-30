<form method="POST" action="{{ $action }}" class="student-form">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="form-grid">
        <div class="field">
            <label for="name">Name <span>*</span></label>
            <input id="name" name="name" type="text" value="{{ old('name', $student->name ?? '') }}" required maxlength="255" autocomplete="name">
            @error('name') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="email">Email <span>*</span></label>
            <input id="email" name="email" type="email" value="{{ old('email', $student->email ?? '') }}" required maxlength="255" autocomplete="email">
            @error('email') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $student->phone ?? '') }}" maxlength="20" autocomplete="tel">
            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="course">Course <span>*</span></label>
            <input id="course" name="course" type="text" value="{{ old('course', $student->course ?? '') }}" required maxlength="255">
            @error('course') <p class="field-error">{{ $message }}</p> @enderror
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-error" role="alert">
            Please correct the highlighted fields and try again.
        </div>
    @endif

    <div class="form-actions">
        <a href="{{ route('students.index') }}" class="btn btn-ghost">Cancel</a>
        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    </div>
</form>

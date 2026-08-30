<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return StudentResource::collection(
            Student::query()->latest('id')->paginate(10)
        );
    }

    public function store(Request $request): StudentResource|JsonResponse
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $student = Student::create($validator->validated());

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Student $student): StudentResource
    {
        return new StudentResource($student);
    }

    public function update(Request $request, Student $student): StudentResource|JsonResponse
    {
        $validator = Validator::make($request->all(), $this->rules($student));

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $student->update($validator->validated());

        return new StudentResource($student->fresh());
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully.',
        ], 200);
    }

    private function rules(?Student $student = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($student),
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'course' => ['required', 'string', 'max:255'],
        ];
    }
}

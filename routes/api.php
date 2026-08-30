<?php

use App\Http\Controllers\Api\StudentController as ApiStudentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('students', ApiStudentController::class)->names('api.students');

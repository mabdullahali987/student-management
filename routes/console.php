<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('students:health', function () {
    $this->comment('Student Management application is ready.');
})->purpose('Check that the application can load Artisan commands.');

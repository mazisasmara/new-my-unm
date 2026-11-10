<?php

use Database\Seeders\SuperAdminSeeder;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:seed-superadmin', function () {
    $this->call('db:seed', ['--class' => SuperAdminSeeder::class]);
})->purpose('Create the superadmin account from the SUPERADMIN_* environment variables');

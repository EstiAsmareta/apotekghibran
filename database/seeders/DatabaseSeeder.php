<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // // \App\Models\admin::factory(10)->create();
        // \App\Models\rak::factory(4)->create();
        // \App\Models\obat::factory(4)->create();

        $this->call([UserRolePermissionSeeder::class]);

    }
}

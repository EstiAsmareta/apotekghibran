<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;


class UserRolePermissionSeeder extends Seeder
{
    protected static $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            // 'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            // 'remember_token' => Str::random(10),
        ];
        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@admin.com',
                'name' => 'admin',
            ], $default_user_value));

            $user = User::create(array_merge([
                'email' => 'user@user.com',
                'name' => 'user',
            ], $default_user_value));

            $role_admin = Role::create(['name' => 'admin']);
            $role_user = Role::create(['name' => 'user']);

            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);

            $role_admin->givePermissionTo('read role');
            $role_admin->givePermissionTo('create role');
            $role_admin->givePermissionTo('update role');
            $role_admin->givePermissionTo('delete role');

            $admin->assignRole('admin');
            $user->assignRole('user');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }


    }
}

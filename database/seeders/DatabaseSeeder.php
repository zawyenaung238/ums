<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => "admin",
            'role_id' => "1",
            'gender' => "male",
            'phone' => "0912345678",
            'address' => "abc street",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('asdffdsa'), // password
            'remember_token' => Str::random(10),
        ]);

        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'hr',
        ]);


        Feature::create([
            'name' => 'user',
        ]);
        Feature::create([
            'name' => 'role',
        ]);
        Feature::create([
            'name' => 'product',
        ]);


        Permission::create([
            "name" => 'create',
            "feature_id" => '1',
        ]);
        Permission::create([
            "name" => 'read',
            "feature_id" => '1',
        ]);
        Permission::create([
            "name" => 'update',
            "feature_id" => '1',
        ]);
        Permission::create([
            "name" => 'delete',
            "feature_id" => '1',
        ]);
        Permission::create([
            "name" => 'create',
            "feature_id" => '2',
        ]);
        Permission::create([
            "name" => 'read',
            "feature_id" => '2',
        ]);
        Permission::create([
            "name" => 'update',
            "feature_id" => '2',
        ]);
        Permission::create([
            "name" => 'delete',
            "feature_id" => '2',
        ]);

        Permission::create([
            "name" => 'create',
            "feature_id" => '3',
        ]);
        Permission::create([
            "name" => 'read',
            "feature_id" => '3',
        ]);
        Permission::create([
            "name" => 'update',
            "feature_id" => '3',
        ]);
        Permission::create([
            "name" => 'delete',
            "feature_id" => '3',
        ]);
    }
}

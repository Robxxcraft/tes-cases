<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //role
        Role::create([
            'id' => 1,
            'role_name' => 'Supervisor',
            'role_description' => 'spv@gmail.com',
        ]);

        Role::create([
            'id' => 2,
            'role_name' => 'Admin',
            'role_description' => 'admin@gmail.com',
        ]);

        Role::create([
            'id' => 3,
            'role_name' => 'Vendor',
            'role_description' => 'vendor@gmail.com',
        ]);

        //user
        User::create([
            'id' => 1,
            'username' => 'UserSpv',
            'email' => 'spv@gmail.com',
            'role_id' => 1,
            // 'password' => Hash::make('Spv12345'),
            'password' => 'Spv12345',
        ]);
        
        User::create([
            'id' => 2,
            'username' => 'UserAdmin',
            'email' => 'admin@gmail.com',
            'role_id' => 2,
            // 'password' => Hash::make('Admin12345'),
            'password' => 'Admin12345',
        ]);
        
        User::create([
            'id' => 3,
            'username' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'role_id' => 3,
            // 'password' => Hash::make('Vendor12345'),
            'password' => 'Vendor12345',
        ]);
        User::create([
            'id' => 4,
            'username' => 'koze',
            'email' => 'koze@mailinator.com',
            'role_id' => 3,
            // 'password' => Hash::make('Vendor12345'),
            'password' => 'koze12345',
        ]);
        User::create([
            'id' => 5,
            'username' => 'cuhuma',
            'email' => 'cuhuma@mailinator.com',
            'role_id' => 1,
            // 'password' => Hash::make('Vendor12345'),
            'password' => 'cuhuma12345',
        ]);
        
        User::create([
            'id' => 6,
            'username' => 'cuhuma',
            'email' => 'cuhuma@mailinator.com',
            'role_id' => 3,
            // 'password' => Hash::make('Vendor12345'),
            'password' => 'cuhuma12345',
        ]);

        User::create([
            'id' => 6,
            'username' => 'bazo',
            'email' => 'bazo@mailinator.com',
            'role_id' => 2,
            // 'password' => Hash::make('Vendor12345'),
            'password' => 'bazo12345',
        ]);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

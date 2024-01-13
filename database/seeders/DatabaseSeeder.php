<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        Role::insert([
            [
                'title' => 'Administrations',
                'slug' => 'administrations',
            ],
            [
                'title' => 'Users',
                'slug' => 'users',
            ]
        ]);

        User::insert([
            [
                'name' => 'Administrations',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => Role::first()->id
            ],
            [
                'name' => 'Users',
                'email' => 'user@mail.com',
                'email_verified_at' => now(),
                'password' =>  Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => Role::orderBy('id', 'desc')->first()->id
            ]
        ]);

        Organization::insert([
            [
                'name' => 'Org-1',
                'slug' => 'org-1',
            ],
            [
                'name' => 'Org-2',
                'slug' => 'org-2',
            ]
        ]);

        Category::insert([
            [
                'name' => 'Cat-1',
                'slug' => 'cat-1',
            ],
            [
                'name' => 'Cat-2',
                'slug' => 'cat-2',
            ]
        ]);

    }
}

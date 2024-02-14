<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         User::factory(10)->create();

//            Listing::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@mail.com'
        ]);
        Listing::factory(10)->create([
            'user_id' => $user->id
        ]);
//         Listing::create([
//                'title' => 'Web Developer',
//                'tags' => 'php, laravel, javascript',
//                'company' => 'Acme',
//                'location' => 'USA',
//                'email' => 'lanvd@gmail.com',
//                'website' => 'http://acme.com',
//                'description' => 'We are looking for a web developer'//
//         ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

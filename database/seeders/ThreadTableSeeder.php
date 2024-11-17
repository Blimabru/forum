<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\User;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        $users->each(function ($user) {
            Thread::factory(3)->create([
                'user_id' => $user->id
            ]);
        });
    }
}

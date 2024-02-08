<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Sequence;

use App\Models\User;
use App\Models\Post;
use App\Models\Group;
use Database\Factories\UserFactory;
use Database\Factories\PostFactory;
use Database\Factories\GroupFactory;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users=User::factory(10)->create();
        Group::factory(3)->hasAttached($users)->create();
        $group=Group::all();
        Post::factory(30)->recycle($users)->recycle($group)->create();
        User::factory()->create([
            'name'=>'admin',
            'email'=>'dddobrat@gmail.com',
            ]);
    }
}

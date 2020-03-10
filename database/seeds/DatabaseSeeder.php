<?php

use App\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
        if($this->command->confirm('Do you want to refresh the database?')){
            $this->command->call('migrate:fresh');
            $this->command->info('Database refreshed');
        }
        // Cache::tags(['blog-post'])->flush();
         $this->call([
        UsersTableSeeder::class,
         BlogPostsTableSeeder::class,
         CommentsTableSeeder::class,
         TagsTableSeeder::class,
         BlogPostTagTableSeeder::class
    ]);


        //
        // $users=$else->concat([$doe]);



        // dd($users->count());
        // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'john@laravel.test',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        //     'remember_token' => Str::random(10)
        // ]);
    }
}

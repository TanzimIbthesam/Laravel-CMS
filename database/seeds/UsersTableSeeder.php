<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $usersCount=(int)$this->command->ask('How many users you would like?',20);
        $usersCount=max((int)$this->command->ask('How many users you would like?',20),1);
        factory(App\User::class)->states('john-doe')->create();
        factory(App\User::class, $usersCount)->create();
        // factory(App\User::class)->states('john-doe')->create();
        // factory(App\User::class, 20)->create();
    }
}

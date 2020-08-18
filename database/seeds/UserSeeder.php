<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function (App\User $user) {
            $user->robots()->save(factory(App\Robot::class)->make());
        });
    }
}

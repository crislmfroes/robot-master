<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\State::class, 50)->create()->each(function (App\State $state) {
            $state->availableParams()->save(factory(App\StateParam::class, 3)->make());
            $state->transitions()->save(factory(App\Transition::class, 3)->make());
            $state->outcomes()->save(factory(App\Outcome::class, 3)->make());
        });
    }
}

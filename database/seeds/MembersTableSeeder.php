<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Member::class, 30)->create()->each(function ($m){
            $m->teams()->attach(App\Models\Team::find(rand(0, 5)));

            // Chances are that one member belongs to serveral groups
            if (rand(0, 1)) {
                $m->teams()->attach(App\Models\Team::find(rand(0, 5)));
            }
        });

        // appoint one member to be leader
        App\Models\Team::all()->each(function ($team) {
            $to_be_leader = $team->members->first();
            $team->members()->updateExistingPivot($to_be_leader->id, ['position' => App\Models\Team::POSITION_LEADER]);
        });
    }
}

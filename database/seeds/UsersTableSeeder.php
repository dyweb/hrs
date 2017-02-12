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
        // admin user
        // an extra member is needed to create new user
        $admin = factory(App\Models\Member::class)->create([
            'email' => 'admin@yeah.net'
        ]);
        
        DB::table('users')->insert([
            'email' => $admin->email,
            'password' => bcrypt('glgjssy'),
            'is_admin' => true
        ]);

        // common user
        $common = factory(App\Models\Member::class)->create([
            'email' => 'common@yeah.net'
        ]);

        DB::table('users')->insert([
            'email' => $common->email,
            'password' => bcrypt('qyhfqbz'),
            'is_admin' => false
        ]);
    }
}

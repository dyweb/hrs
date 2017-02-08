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
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'the_admin_guy@yeah.net',
            'password' => bcrypt('glgjssy'),
            'is_admin' => true
        ]);

        // common user
        DB::table('users')->insert([
            'name' => 'alice',
            'email' => 'the_ordinary_guy@yeah.net',
            'password' => bcrypt('qyhfqbz'),
            'is_admin' => false
        ]);
    }
}

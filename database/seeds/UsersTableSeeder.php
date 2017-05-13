<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'polladmin',
            'email' => 'polladmin@cloudhorizon.com',
            'password' => '$2y$10$yDALvhzbl0ycID4ycWqcM.FnwUaopdUPUXhkj62TCR/LzYimWT/xa',
            'activated' => 1,
            'role' => 'admin',
        ]);
    }
}

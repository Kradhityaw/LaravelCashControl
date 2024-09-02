<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Kevind Radhitya',
                'email' => 'kevind@gmail.com',
                'saldo' => 2000000,
                'password' => bcrypt('12345678')
            ],
            [
                'name' => 'Asep Radhitya',
                'email' => 'asep@gmail.com',
                'saldo' => 1000000,
                'password' => bcrypt('12345678')
            ],
        ]);

        DB::table('groups')->insert([
            [
                'nama' => 'Big 4',
                'deskripsi' => 'okelah'
            ]
        ]);

        DB::table('roles')->insert([
            [
                'role' => 'Owner'
            ],
            [
                'role' => 'Member'
            ],
        ]);

        DB::table('group_user')->insert([
            [
                'user_id' => 1,
                'group_id' => 1,
                'role_id' => 1
            ],
            [
                'user_id' => 2,
                'group_id' => 1,
                'role_id' => 2
            ],
        ]);
    }
}

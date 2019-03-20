<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Super',
                'lastname' => 'Admin',
                'email' => 'example@example.it',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Owner',
                'lastname' => 'User',
                'email' => 'example2@example.it',
                'password' => Hash::make('123456')
            ],
        ];

        User::insert($users);
    }
}

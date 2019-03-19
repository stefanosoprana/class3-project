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
        $new_user = new User;

        $new_user->name = 'Chiara';
        $new_user->lastname = 'Passaro';
        $new_user->email = 'email@email.it';
        $new_user->password =  Hash::make('123456');

        $new_user->save();
    }
}

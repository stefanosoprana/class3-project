<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

      $newUser = new User;

      $newUser->name = 'Super';
      $newUser->lastname = 'Admin';
      $newUser->email = 'example@example.it';
      $newUser->password = Hash::make("esempio");


      $newUser->save();


        for ($i=0; $i < 10; $i++) {
          $newUser = new User;

          $newUser->name = $faker->firstName;
          $newUser->lastname = $faker->lastName;
          $newUser->email = $faker->unique()->email;
          $newUser->password = Hash::make("esempio");


          $newUser->save();
        }
    }
}

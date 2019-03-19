<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\Message;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // for ($i=0; $i < 10 ; $i++) {
        //   $newMessage = new Message;
        //
        //   $newMessage->apartment_id = $faker->numberBetween($min = 1, $max = 2);
        //   $newMessage->user_id = $faker->numberBetween($min = 1, $max = 2);
        //   $newMessage->text = $faker->text($maxNbChars = 100);
        //   $newMessage->email = $faker->email;
        //   $newMessage->date = $faker->dateTime($max = 'now', $timezone = null);
        //
        //   $newMessage->save();
        //
        // }

        // da rivedere perché alcuni dati non matchano
    }
}

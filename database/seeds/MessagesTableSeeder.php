<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Support\Carbon;
use App\Message;
use App\Apartment;
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
        $data = [

        ];

        for ($i=0; $i < 3000; $i++) {

          $now = Carbon::now();
          $apartment = Apartment::inRandomOrder()->first();
            $date = $faker->dateTimeBetween('-2 years', $endDate = 'now', $timezone = 'Europe/Rome');

            $user = $apartment["user_id"];
            $data[] = [
              "apartment_id" => $apartment["id"],
              "user_id" => $user,
              "text" =>$faker->text($maxNbChars = 100),
              "email"=>$faker->unique()->email,
              "name" =>$faker->firstName,
              "created_at" => $date,
              "updated_at" => $date,
            ];



        }

        Message::insert($data);

    }
}

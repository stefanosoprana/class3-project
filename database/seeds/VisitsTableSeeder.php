<?php

use Illuminate\Database\Seeder;
use App\Visit;
use App\Apartment;
use Faker\Generator as Faker;
class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      $data = [];

      for ($i=0; $i < 3000; $i++) {

        $apartment = Apartment::inRandomOrder()->first();
        $date = $faker->dateTimeBetween('-2 years', $endDate = 'now', $timezone = 'Europe/Rome');
          $data[] = [
            "apartment_id" => $apartment["id"],
            "ip" => $faker->ipv4,
            "created_at" => $date,
            "updated_at" => $date,
          ];
      }

      Visit::insert($data);
    }
}

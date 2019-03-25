<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Sponsorship;
use App\Apartment;
use App\SponsorshipsType;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // var_dump($sponsorId["period"]);
        // dd($period);
          $data = [

          ];

          $apartments = [];

          do {
          $now = Carbon::now();
          $apartment = Apartment::inRandomOrder()->first();
          if (!in_array($apartment["id"],$apartments)) {

            $sponsorId = SponsorshipsType::inRandomOrder()->first();

            $period = $now->addHours($sponsorId["period"]);

            $data[] = [
              "apartment_id" => $apartment["id"],
              "sponsorships_type_id" => $sponsorId["id"],
              "sponsor_expired" =>$period
            ];

            $apartments[] = $apartment["id"];




          }

        } while (count($apartments)< 5);


        Sponsorship::insert($data);





    }
}

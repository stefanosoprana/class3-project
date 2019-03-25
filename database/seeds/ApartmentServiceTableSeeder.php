<?php

use Illuminate\Database\Seeder;
use App\Apartment;

class ApartmentServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $apartments = Apartment::all();

          $data = [
              [
                  'apartment_id' => 1,
                  'service_id' => 1
              ]
          ];

          foreach ($apartments as $apartment){
              foreach ($data as $this_data){

                  if($apartment->id === $this_data['service_id']){
                      $apartment->services()->attach($this_data['service_id']);
                  }

              }
          }
    }
}

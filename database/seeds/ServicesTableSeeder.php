<?php
use Illuminate\Database\Seeder;
use App\Service;
use Illuminate\Support\Str;
class ServicesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       $services = ['WiFi ','Piscina ','Aria condizionata ','Angolo Cottura ','Vasca Idromassaggio ', 'Balcone' ];
       foreach ($services as $service) {
         $newService = new Service ;

         $newService->name = $service;

         $newService->save();



       }
   }
}

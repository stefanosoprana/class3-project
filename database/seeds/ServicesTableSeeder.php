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
       $services = [
           [
               'name' => 'WiFi',
               'icon' => '<i class="fas fa-wifi"></i>',
           ],
           [
               'name' => 'Piscina',
               'icon' => '<i class="fas fa-swimming-pool"></i>',
           ],
           [
               'name' => 'Aria condizionata',
               'icon' => '<i class="fas fa-snowflake"></i>',
           ],
           [
               'name' => 'Angolo Cottura',
               'icon' => '<i class="fas fa-utensils"></i>',
           ],
           [
               'name' => 'Vasca Idromassaggio',
               'icon' => '<i class="fas fa-hot-tub"></i>',
           ],
           [
               'name' => 'Accessibile',
               'icon' => '<i class="fas fa-wheelchair"></i>',
           ]
       ];
       foreach ($services as $service) {
         $newService = new Service ;

         $newService->name = $service['name'];
         $newService->icon = $service['icon'];

         $newService->save();



       }
   }
}

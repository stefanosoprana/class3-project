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
               'icon' => 'fas fa-wifi',
           ],
           [
               'name' => 'Piscina',
               'icon' => 'fas fa-swimming-pool',
           ],
           [
               'name' => 'Aria condizionata',
               'icon' => 'fas fa-snowflake',
           ],
           [
               'name' => 'Angolo Cottura',
               'icon' => 'fas fa-utensils',
           ],
           [
               'name' => 'Vasca Idromassaggio',
               'icon' => 'fas fa-hot-tub',
           ],
           [
               'name' => 'Accessibile',
               'icon' => 'fas fa-wheelchair',
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

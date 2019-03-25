<?php
use Illuminate\Database\Seeder;
use App\SponsorshipsType;
use Illuminate\Support\Str;


class SponsorshipsTypeTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
          $typeSponsor= [
           [
               'name' => '24 ore di sponsorizzazione',
               'price' => 2.99,
               'period' => 24
           ],
           [
               'name' => '48 ore di sponsorizzazione' ,
               'price' => 4.99,
               'period' => 48
           ],
           [
               'name' => '72 ore di sponsorizzazione ',
               'price' => 7.99,
               'period' => 72
           ]
       ];
       SponsorshipsType::insert($typeSponsor);


   }
}

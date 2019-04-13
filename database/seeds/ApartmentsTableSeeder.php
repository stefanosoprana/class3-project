<?php
use Illuminate\Database\Seeder;
use App\Apartment;
use Faker\Generator as Faker;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $files = Storage::allFiles('public/apartment_image/');
        $files = str_replace("public/", "", $files);

        $json = File::get("database/data/comuni.json"); //from database MatteoHenryChinaski

        $cities = json_decode($json);

        foreach ($cities as $city) {
            $gapi = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . floatval($city->lat) .',' . floatval($city->lon) . '&key=' . config('app.google_api_key');
            $json_resp = file_get_contents($gapi);
            $adress = json_decode($json_resp, true);
            if($adress['results'] > 0){
                foreach ($adress['results'][0]['address_components'] as $address_component) {
                    if(in_array("street_number", $address_component['types'] )){
                        $number = intval($address_component['long_name']);
                    }
                    if(in_array("route", $address_component['types'] )){
                        $street = $address_component['long_name'];
                    }
                }
            }

            $newApt = new Apartment;

            $newApt->user_id = $faker->numberBetween($min = 1, $max = 10);
            $newApt->title = $faker->sentence(4);
            $newApt->description = $faker->paragraph(10);
            $newApt->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 2000);
            $newApt->rooms = $faker->numberBetween($min = 1, $max = 15);
            $newApt->beds = $faker->numberBetween($min = 1, $max = 10);
            $newApt->bathrooms = $faker->numberBetween($min = 1, $max = 10);
            $newApt->square_meters = $faker->numberBetween($min = 30, $max = 400);
            $newApt->street = $street;
            $newApt->locality = $city->city;
            $newApt->house_number = $number;
            $newApt->postal_code = intval($city->cap);
            $newApt->state = 'Italy';
            $newApt->latitude = floatval($city->lat);
            $newApt->longitude = floatval($city->lon);
            $newApt->image = $files[rand(0, count($files) - 1)];
            $newApt->published = $faker->numberBetween($min = 0, $max = 1);

            $newApt->save();
        }
    }
}

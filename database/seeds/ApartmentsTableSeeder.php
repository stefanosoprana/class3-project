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

            $newApt = new Apartment;

            $newApt->user_id = $faker->numberBetween($min = 1, $max = 10);
            $newApt->title = $faker->sentence(4);
            $newApt->description = $faker->paragraph(10);
            $newApt->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 2000);
            $newApt->rooms = $faker->numberBetween($min = 1, $max = 15);
            $newApt->beds = $faker->numberBetween($min = 1, $max = 10);
            $newApt->bathrooms = $faker->numberBetween($min = 1, $max = 10);
            $newApt->square_meters = $faker->numberBetween($min = 30, $max = 400);
            $newApt->street = $faker->streetName;
            $newApt->locality = $city->city;
            $newApt->house_number = $faker->numberBetween($min = 1, $max = 20);
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

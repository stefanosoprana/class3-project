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

          for ($i=0; $i < 30 ; $i++) {

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
            $newApt->locality = $faker->city;
            $newApt->house_number = $faker->buildingNumber;
            $newApt->postal_code = $faker->randomNumber($nbDigits = NULL, $strict = false);
            $newApt->state = 'Italy';
            $newApt->latitude = $faker->latitude($min = -90, $max = 90);
            $newApt->longitude = $faker->longitude($min = -180, $max = 180);
            $newApt->image = $files[rand(0, count($files) - 1)];
            $newApt->published = $faker->numberBetween($min = 0, $max = 1);

            $newApt->save();
          }
      }
  }

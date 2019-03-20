<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $now = Carbon::now();

            $permissions = [
                [
                    'name'=> 'modify',
                    'display_name'=> 'Modificare',
                    'description'=> 'L\'utente può modificare i contenuti',
                    'created_at'=> $now,
                    'updated_at'=> $now,
                ]
            ];

            Permission::insert($permissions);

        }
    }
}

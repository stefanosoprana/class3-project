<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $data = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Amministratore del sito',
                'created_at' => $now,
                'updated_at' =>  $now,
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'User registrato',
                'created_at' => $now,
                'updated_at' =>  $now,
            ]
        ];

        Role::insert($data);

    }
}

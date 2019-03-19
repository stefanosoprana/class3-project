<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        $data = [
            [
                'user_id' => 1,
                'role_id' => 1
            ]
        ];

        foreach ($roles as $role){
            foreach ($data as $this_data){

                if($role->id === $this_data['user_id']){
                    $role->users()->attach($this_data['user_id']);
                }

            }
        }
    }
}

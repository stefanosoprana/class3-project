<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $data = [
            [
                'permission_id' => 1,
                'role_id'=> 1
            ]
        ];

        foreach ($permissions as $permission){
            foreach ($data as $this_data){

                if($permission->id === $this_data['permission_id']){
                    $permission->roles()->attach($this_data['role_id']);
                }

            }
        }

    }
}

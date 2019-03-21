<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(ApartmentsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SponsorshipsTypeTableSeeder::class);
        $this->call(ApartmentServiceTableSeeder::class);


    }
}

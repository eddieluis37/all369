<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rrhh\OrganizationalUnit;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ou = OrganizationalUnit::first();

         // First user
        $user = new User();
        $user->id = 12345678;
        $user->dv = 9;
        $user->name = "Administrador";
        $user->fathers_family = "Pinto";
        $user->mothers_family = "Casas";
        $user->password = bcrypt('admin');
        $user->position = "Administrator";
        $user->email = "sistemas.sst@redsalud.gob.cl";
        $user->organizationalUnit()->associate($ou);
        $user->save();
        $user->assignRole('god');
/*
         // Second user
        $user2 = new User();
        $user2->id = 12345679; // Ensure unique ID
        $user2->dv = 8;
        $user2->name = "User One";
        $user2->fathers_family = "Smith";
        $user2->mothers_family = "Johnson";
        $user2->password = bcrypt('password1');
        $user2->position = "User";
        $user2->email = "sistemas.sst@redsalud.gob.cl";
        $user2->organizationalUnit()->associate($ou);
        $user2->save();
        $user2->assignRole('user');

        // Third user
        $user3 = new User();
        $user3->id = 12345680; // Ensure unique ID
        $user3->dv = 7;
        $user3->name = "User Two";
        $user3->fathers_family = "Doe";
        $user3->mothers_family = "Roe";
        $user3->password = bcrypt('password2');
        $user3->position = "User";
      //  $user3->email = "user2@example.com";
        $user3->organizationalUnit()->associate($ou);
        $user3->save(); 
        $user3->assignRole('user');*/
    }
}

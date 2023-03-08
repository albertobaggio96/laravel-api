<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->name = 'Alberto Baggio';
        $newUser->email = 'albi1313@hotmail.it';
        $newUser->password = Hash::make('albertobaggio');
        $newUser->save();

        for($i = 0; $i < 10; $i++ ){
            $newUser = new User();
        $newUser->name = $faker->name();
        $newUser->email = $faker->email();
        $newUser->password = Hash::make('albertobaggio');
        $newUser->save();
        }
    }
}

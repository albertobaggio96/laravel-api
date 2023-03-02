<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=["Back-End", "Front-End", "Full-Stack"];

       foreach($types as $type){
            $newType= new Type();
            $newType->type= $type;
            $newType->save();
       }
    }
}

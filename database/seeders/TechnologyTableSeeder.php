<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;


class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML5', 'CSS3', 'SCSS', 'Bootstrap 5', 'JS ES6', 'Vue 3', 'Vite', 'PHP', 'Laravel 9'];

        foreach($technologies as $technology){
            $newTechnology = new Technology();
            $newTechnology->technology= $technology;
            $newTechnology->slug= Str::slug($newTechnology->technology);
            $newTechnology->save();
            $newTechnology->slug .= "-$newTechnology->id";
            $newTechnology->update();
        }
    }
}

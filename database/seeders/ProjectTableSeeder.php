<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 60; $i++){
            $newProject = new Project();

            $newProject->type_id = Type::inRandomOrder()->first()->id;

            $newProject->title = $faker->unique()->sentence(3);
            $newProject->slug = Str::slug($newProject->title);
            $newProject->author = "Alberto Baggio";
            $newProject->date = $faker->date();
            $newProject->preview = $faker->imageUrl(640, 640);
            
            $newProject->save();
        }
    }
}

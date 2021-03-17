<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,20) as $item)
        {
            $name = $faker->name;
            $slug = Str::slug($name,'-');
            Category::create([
                "name" => $name,
                "slug" => $slug,
                "description" => $faker->sentence,
                "status" => rand(0,1),
            ]);
        }
    }
}

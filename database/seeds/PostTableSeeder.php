<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostTableSeeder extends Seeder
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
             Post::create([
                 "user_id" => rand(1,20),
                 "category_id" => rand(1,5),
                 "title" => $faker->sentence,
                 "description" => $faker->paragraph,
                 "thumbnail" => $faker->imageUrl(),
                 "status" => $this->getStatus()
             ]);
         }
    }
    public function getStatus()
    {
        $status = array('draft','published');
        return $status[array_rand($status)];
    }
}

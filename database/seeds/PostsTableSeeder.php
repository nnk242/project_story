<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        for ($i = 0; $i <= 50; $i++) {
            $post = new Post();
            $user_id = 1;
            $type = rand(1, 4);
            $status = rand(0, 1);
            $post->fill([
                'title' => $faker->realText(rand(10, 40)),
                'type' => $type,
                'content' => '<p>' . $faker->realText(rand(50, 1000)) . '</p>',
                'short_content' => '<p>' . $faker->realText(rand(20, 100)) . '</p>',
                'user_id' => $user_id,
                'status' => $status,

            ]);
            $post->save();
        }
    }
}

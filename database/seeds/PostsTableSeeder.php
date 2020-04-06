<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker\Factory::create();
        \DB::table('posts')->truncate();
        for($i=0;$i<100;$i++){
        \DB::table('posts')->insert([
            'title'=>$faker->text(20),
            'shortDescription'=>$faker->text(30),
            'image'=>'/themes/front/img/blog-post-4.jpeg',
            'post_author_id'=>$faker->numberBetween(1,10),
            'post_category_id'=>$faker->numberBetween(1,10),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            
        ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class PostCategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();
        $allCategories = ['Economics', 'Parenting', 'Career', 'Pet', 'Gaming', 'Medical', 'Sports', 'Shopping', 'Fitness', 'Movie'];
        \DB::table('post_categories')->truncate();
        foreach ($allCategories as $category) {
            \DB::table('post_categories')->insert([
                'name' => $category,
                'description'=>$faker->text(50),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

}

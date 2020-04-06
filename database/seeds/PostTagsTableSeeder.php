<?php

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $allTags = ['Economics', 'Parenting', 'Career', 'Pet', 'Gaming', 'Medical', 'Sports', 'Shopping', 'Fitness', 'Movie'];
        \DB::table('post_tags')->truncate();
        foreach ($allTags as $tag) {
            \DB::table('post_tags')->insert([
                'name'=>$tag,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
    }

}

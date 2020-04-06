<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= \Faker\Factory::create();
        \DB::table('comments')->truncate();
        for($i=0;$i<300;$i++){
        \DB::table('comments')->insert([
            'name_of_visitor'=>$faker->name,
            'email_of_visitor'=>$faker->email,
            'content'=>$faker->text(40),
            'post_id'=>$faker->numberBetween(1,100),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        }
        
    }
}

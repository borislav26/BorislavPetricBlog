<?php

use Illuminate\Database\Seeder;

class SliderItemsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('slider_items')->truncate();
        \DB::table('slider_items')->insert([
            'image' => '/themes/front/img/featured-pic-1.jpeg',
            'url' => '/../resources/views/',
            'button_name' => 'DISCOVER MORE',
            'order' => 1,
            'title' => 'Bootstrap 4 Blog - A free template by Bootstrap Temple',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('slider_items')->insert([
            'image' => '/themes/front/img/featured-pic-2.jpeg',
            'url' => '/../resources/views/',
            'button_name' => 'DISCOVER MORE',
            'order' => 2,
            'title' => 'Bootstrap 4 Blog - A free template by Bootstrap Temple',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('slider_items')->insert([
            'image' => '/themes/front/img/featured-pic-3.jpeg',
            'url' => '/../resources/views/',
            'button_name' => 'CHECKOUT MORE',
            'order' => 3,
            'title' => 'Bootstrap 4 Blog - A free template by Bootstrap Temple',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}

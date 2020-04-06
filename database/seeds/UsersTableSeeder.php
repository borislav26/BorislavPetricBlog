<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = \Faker\Factory::create();
        \DB::table('users')->truncate();

        for ($i = 0; $i < 10; $i++) {
            \DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->email,
                'password' => \Hash::make('trenerka'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        \DB::table('users')->insert([
            'name' => 'Borislav Petric',
            'email' => 'borislavpetric66@gmail.com',
            'password' => \Hash::make('trenerka'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        \DB::table('users')->insert([
            'name' => 'Aleksandar Dimic',
            'email' => 'dimi7even@cubes.rs',
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}

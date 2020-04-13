<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('messages')->truncate();

        $faker = \Faker\Factory::create();

        $users = App\User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                \DB::table('messages')->insert([
                'user_from_id' => $user->id,
                'user_to_id' => $faker->numberBetween(1, 12),
                'content' => $faker->text(),
                'is_read' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }

}

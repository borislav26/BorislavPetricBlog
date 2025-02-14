<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SliderItemsTableSeeder::class);
         $this->call(PostCategoriesTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PostTagsTableSeeder::class);
         $this->call(PostHasTagsTableSeeder::class);
         $this->call(CommentsTableSeeder::class);
         $this->call(UserRolesTableSeeder::class);
    }
}
